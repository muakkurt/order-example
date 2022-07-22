<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'sub_total',
        'total',
        'total_discounts',
        'customer_id',
        'created_at',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }

    public function histories(): HasMany
    {
        return $this->hasMany(OrderHistory::class, 'order_id', 'id');
    }

    public function discounts(): HasMany
    {
        return $this->hasMany(OrderHistory::class, 'order_id', 'id')
                ->where('type', '=', 'discount');
    }

    public function total(): float|int
    {
        return $this->histories->sum('value');
    }

    public function totalDiscounts(): float|int
    {
        return abs($this->discounts->sum('value'));
    }

    public function discountedTotal(): float|int
    {
        return $this->sub_total - $this->total_discounts;
    }

    public function delete(){
        parent::delete();

        $this->products()->delete();
        $this->histories()->delete();
    }
}
