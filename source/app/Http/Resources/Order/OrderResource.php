<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Product\ProductCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'customerId' =>  $this->customer_id,
            'items' => new ProductCollection($this->products),
            'total' => format_money($this->total)
        ];
    }
}
