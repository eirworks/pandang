<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description',
    ];

    protected $attributes = [
        'description' => '',
    ];

    public function monitors()
    {
        return $this->hasMany(Monitor::class);
    }
}
