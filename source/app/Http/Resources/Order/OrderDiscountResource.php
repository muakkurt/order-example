<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDiscountResource extends JsonResource
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
                'discountReason' => $this->name,
                'discountAmount' => format_money(abs($this->value)),
                'subtotal' => format_money($this->sub_total)
        ];
    }
}
