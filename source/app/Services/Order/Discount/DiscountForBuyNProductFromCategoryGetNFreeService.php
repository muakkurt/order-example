<?php

namespace App\Services\Order\Discount;

use App\Models\Discount;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class DiscountForBuyNProductFromCategoryGetNFreeService implements DiscountServiceInterface
{
    public static function run(Order $order, Discount $discount): Order
    {
        $orderProducts = $order->products()
            ->where('quantity', '>=', $discount->decision_limit)
            ->whereHas('product', function ($query) use ($discount) {
                $query->where('category_id', $discount->relation_id);
            })
            ->get();

        if (empty($orderProducts)){
            return $order;
        }

        foreach ($orderProducts as $orderProduct){
            $discountValue = -abs(floor($orderProduct->quantity / $discount->decision_limit) * $orderProduct->unit_price);

            $order->load('histories');
            $order->histories()->create([
                'name'          => $discount->name,
                'related_id'    => $orderProduct->product_id,
                'description'   => "Discount has been applied to [{$orderProduct->name}] product ([{$orderProduct->product_id}]'id).",
                'subject_type'  => Discount::class,
                'subject_id'    => $discount->id,
                'type'          => 'discount',
                'value'         => $discountValue,
                'sub_total'     => $order->total() + $discountValue,
            ]);
        }

        return $order;
    }
}
