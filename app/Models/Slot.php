<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function busRoute(){
        return $this->hasOne(BusRoute::class,'id','route_id');
    }
    public function busInfo()
    {
        return $this->hasOne(Bus::class,'id','bus_id');
    }
    public function driverInfo()
    {
        return $this->hasOne(Driver::class,'id','driver_id');
    }
    public function cartInfo()
    {
        return $this->hasMany(Cart::class);
    }


}
