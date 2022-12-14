<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorOrdersTimeline extends Model
{
    use HasFactory;
    protected $table='vendor_order_timelines';

    protected $fillable=[
        'order_id','order_status','updated_by'
    ];
}
