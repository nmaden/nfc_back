<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class ClientPhone extends Model
{
    protected $fillable = [
        'name',
        'value',
        'user_id',
        'show'
    ];

    protected $casts = [
        'show' => 'boolean',
    ];
}
