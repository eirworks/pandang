<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ping extends Model
{
    use HasFactory;

    protected $casts = [
        'request' => 'collection',
        'response' => 'collection',
    ];

    protected $fillable = [
        'status', 'response', 'request', 'time'
    ];
}
