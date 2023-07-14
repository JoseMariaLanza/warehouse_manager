<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftDetail extends Model
{
    use HasFactory;

    protected $fillable = [
            'product_code',
            'product_description',
            'quantity',
            'order_description',
            'np_comment',
            'receipt_type',
            'sales_line',
            'state_province'
    ];
}
