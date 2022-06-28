<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function office()
    {
        return $this->belongsTo(Office::class,'office_id','id');
    }

    public function client()
    {
        return $this->hasOne(User::class,'id','client_id');
    }
}
