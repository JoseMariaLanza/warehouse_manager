<?php

namespace App\Models\Shifts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    // protected $guard = 'shifts';
    protected $connection = 'core';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'shift_date',
        'start_time',
        'finish_time',
        'init_weight',
        'final_weight',
        'remit',
        'assigned_shipment_street',
        'shift_type',
        'prestressed',
        'vip_shift',
        'state_province',
        'start_shift',
        'finish_shift',
    ];
}
