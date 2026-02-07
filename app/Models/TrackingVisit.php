<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_id',
        'ip',
        'user_agent'
    ];
}
