<?php

namespace App\Services\Order\Discount;

use App\Models\Discount;
use App\Models\Order;

interface DiscountServiceInterface
{
    public static function run(Order $order, Discount $discount): Order;
}
