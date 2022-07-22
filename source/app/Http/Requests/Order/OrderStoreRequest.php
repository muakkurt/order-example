<?php

namespace App\Http\Requests\Order;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'customer_id'           => 'required|integer|exists:' . Customer::class . ',id',
            'products'              => 'required|array|min:1',
            'products.*.id'         => 'required|integer|distinct|exists:' . Product::class . ',id',
            'products.*.quantity'   => 'required|integer|min:1',
        ];
    }
}
