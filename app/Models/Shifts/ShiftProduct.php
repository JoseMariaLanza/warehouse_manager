<?php

namespace App\Models\Shifts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'shift_id',
        'product_code',
        'product_description',
        'quantity',
        'order_description',
        'np_comment',
        'receipt_type',
        'sales_line',
        'state_province',
    ];
}
