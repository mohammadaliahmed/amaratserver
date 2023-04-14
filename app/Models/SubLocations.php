<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubLocations extends Model
{
    use HasFactory;
    protected $table='locations';

    protected $fillable=['name','location_id'];

}
