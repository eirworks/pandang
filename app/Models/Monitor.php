<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    use HasFactory;

    public function pings()
    {
        return $this->hasMany(Ping::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
