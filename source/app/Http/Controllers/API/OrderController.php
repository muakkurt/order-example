<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderStoreRequest;
use App\Http\Resources\Order\OrderCollection;
use App\Http\Resources\Order\OrderResource;
use App\Http\Traits\ApiResponserTrait;
use App\Models\Order;
use App\Services\Order\OrderService;

class OrderController extends Controller
{
    use ApiResponserTrait;

    public function index(){
        return $this->successResponse(
            new OrderCollection(Order::with(['histories', 'products'])->get())
        );
    }

    public function store(OrderStoreRequest $request, OrderService $orderService){
        return $this->successResponse(new OrderResource($orderService->store($request)));
    }

    public function delete(Order $order){
        $order->delete();
        return $this->successResponse([]);
    }
}
