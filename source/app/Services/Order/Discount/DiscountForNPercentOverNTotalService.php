<?php

namespace App\Services\Order\Discount;

use App\Models\Discount;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class DiscountForNPercentOverNTotalService implements DiscountServiceInterface
{
    public static function run(Order $order, Discount $discount): Order
    {
        $totalPrice = $order->histories()->sum('value');

        if ($totalPrice < $discount->decision_limit){
            return $order;
        }

        $discountValue = -abs(($totalPrice / 100) * $discount->value);

        $order->load('histories');
        $order->histories()->create([
            'name'          => $discount->name,
            'description'   => "Discount has been applied for total price is greater or equal than 1000",
            'subject_type'  => Discount::class,
            'subject_id'    => $discount->id,
            'type'          => 'discount',
            'value'         => $discountValue,
            'sub_total'     => $order->total() + $discountValue,
        ]);

        return $order;
    }
}
