<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $connection = 'core';

    use HasFactory;
    protected $fillable = [
        'quantity',
    ];
}
