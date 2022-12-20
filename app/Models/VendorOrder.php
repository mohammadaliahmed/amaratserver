<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorOrder extends Model
{
    protected $table='vendor_orders';
    use HasFactory;
    protected $fillable=[
      'vendor_id','product_id','sale_id','quantity','status'
    ];

    public function vendor(){
        return $this->hasOne('App\Models\Vendor','id','vendor_id');
    }
    public function product(){
        return $this->hasOne('App\Models\Product','id','product_id');
    }
}
