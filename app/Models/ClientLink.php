<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class ClientLink extends Model
{
    protected $fillable = [
        'name',
        'value',
        'icon',
        'user_id',
        'show'
    ];
    protected $casts = [
        'show' => 'boolean',
    ];

}
