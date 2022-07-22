<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'productId' => $this->product_id,
            'quantity' => $this->quantity,
            'unitPrice' => format_money($this->unit_price),
            'total' => format_money($this->total)
        ];
    }
}
