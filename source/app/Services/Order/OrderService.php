<?php

namespace App\Services\Order;

use App\Exceptions\Order\InvalidStockException;
use App\Http\Requests\Order\OrderStoreRequest;
use App\Models\Customer;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Product;
use App\Services\Customer\CustomerService;
use App\Services\Product\ProductService;
use Exception;
use Illuminate\Support\Facades\DB;


class OrderService{

    public function store(OrderStoreRequest $request): Order
    {
        $validated = $request->validated();
        DB::beginTransaction();

        try{

            $order = Order::create([
                'customer_id' => $validated['customer_id']
            ]);

            foreach($validated['products'] as $requestProduct){
                $this->addOrderProduct($requestProduct, $order);
            }

            $subTotal = $order->products->sum('total');

            $order->histories()->create([
                'name'       => 'SUB_TOTAL',
                'value'      => $subTotal,
                'sub_total'  => $subTotal,
            ]);

            $this->addOrderDiscounts($order);

            $order->load('histories');
            $order->update([
                'sub_total'         => $subTotal,
                'total'             => $order->total(),
                'total_discounts'   => $order->totalDiscounts()
            ]);

            (new CustomerService())->setCustomerRevenue(Customer::find($validated['customer_id']));

            DB::commit();

            return $order;

        }catch(Exception $exception){
            DB::rollBack();
            throw $exception;
        }
    }

    private function addOrderProduct(array $requestProduct, $order){
        $product = Product::find($requestProduct['id']);
        if($product->stock < $requestProduct['quantity']){
            throw new InvalidStockException('Invalid stock', [
                $requestProduct['id'] => "The product [{$product->name}] with {$requestProduct['id']} id is not available in stock."
            ]);
        }

        $order->products()->create([
            'name' => $product->name,
            'quantity' => $requestProduct['quantity'],
            'unit_price' => $product->price,
            'total' => $product->price * $requestProduct['quantity'],
            'product_id' => $product->id,
        ]);

        (new ProductService())->decreaseProductStock($product, $requestProduct['quantity']);
    }

    private function addOrderDiscounts($order){
        $discounts = Discount::active()->orderBy('priority', 'ASC')->get();
        foreach($discounts ?? [] as $discount){
            $discount->discount_class::run($order, $discount);
        }
    }
}
