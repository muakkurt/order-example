<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'name',
        'discount_class',
        'priority',
        'created_at',
    ];

    public function scopeActive($query)
    {
        $query->where('is_active', true);
    }
}
