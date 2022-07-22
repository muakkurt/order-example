<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderDiscountsResource;
use App\Http\Traits\ApiResponserTrait;
use App\Models\Order;

class OrderDiscountController extends Controller
{
    use ApiResponserTrait;

    public function index(Order $order){

        return $this->successResponse(new OrderDiscountsResource($order));

    }
}