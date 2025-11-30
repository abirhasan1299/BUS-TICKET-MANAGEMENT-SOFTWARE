<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function slots()
    {
        return $this->belongsTo(Slot::class,'slot_id','id');
    }
}
