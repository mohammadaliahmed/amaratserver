<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SelledItems extends Model
{
    protected $fillable = [
        'sell_id',
        'product_id',
        'price',
        'quantity',
        'tax_id',
        'tax',
        'status'
    ];

    public function product(){
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }
}
