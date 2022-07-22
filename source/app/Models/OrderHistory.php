<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'related_id',
        'description',
        'subject_type',
        'subject_id',
        'value',
        'sub_total',
        'type',
        'order_id',
        'created_at',
    ];
}
