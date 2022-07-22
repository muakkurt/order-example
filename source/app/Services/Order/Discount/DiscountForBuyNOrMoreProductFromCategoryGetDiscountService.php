<?php

namespace App\Services\Order\Discount;

use App\Models\Discount;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class DiscountForBuyNOrMoreProductFromCategoryGetDiscountService implements DiscountServiceInterface
{
    public static function run(Order $order, Discount $discount): Order
    {
        $orderProduct = $order->products()
            ->select('*', DB::raw('SUM(quantity) as total_quantity'))
            ->whereHas('product', function ($query) use ($discount) {
                $query->where('category_id', $discount->relation_id);
            })
            ->groupBy('id')
            ->having('total_quantity', '>=', $discount->decision_limit)
            ->orderBy('unit_price', 'ASC')
            ->first();

        if (empty($orderProduct)){
            return $order;
        }

        $discountValue = -abs((float) ($orderProduct->unit_price / 100) * $discount->value);
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

        return $order;
    }
}
