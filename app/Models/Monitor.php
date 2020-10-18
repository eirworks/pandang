<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    use HasFactory;

    const SETTING_SEND_ALERT = "send_alert";
    const SETTING_DOWNTIME_DELAYS = "downtime_delays";
    const SETTING_FILTER_ERROR_TYPE = "filter_error_type";
    const SETTING_SMS_NUMBER = "sms_number";

    protected $casts = [
        'activated' => 'boolean',
        'data' => 'collection',
        'settings' => 'collection',
    ];

    protected $fillable = [
        'name',
        'url'
    ];

    protected $attributes = [
        'data' => [],
    ];

    public function pings()
    {
        return $this->hasMany(Ping::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
