<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function slots()
    {
        return $this->belongsTo(Slot::class,'slot_id','id');
    }
    public function coupons()
    {
        return $this->belongsTo(Coupon::class,'coupon','id');
    }
}
