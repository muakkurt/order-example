<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDiscountsResource extends JsonResource
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
            'orderId' => $this->id,
            'discounts' =>  new OrderDiscountCollection($this->discounts),
            'totalDiscount' => format_money($this->total_discounts),
            'discountedTotal' => format_money($this->discountedTotal()),
        ];
    }
}
