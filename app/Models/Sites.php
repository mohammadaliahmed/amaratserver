<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sites extends Model
{
    use HasFactory;
    protected $table='sites';
    protected $fillable=[
        'customer_id',
        'name',
        'address',
        'city',
        'details',
        'latitude',
        'longitude',
    ];
}
