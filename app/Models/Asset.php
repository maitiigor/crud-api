<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'serial_number',
        'description',
        'fixed_or_movable',
        'picture_path',
        'purchase_price',
        'purchase_expiry_date',
        'purchase_date',
        'start_use_date',
        'purchase_use_date',
        'warranty_expiry_date',
        'degradation_in_years',
        'current_value_in_naira',
        'location'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];
}
