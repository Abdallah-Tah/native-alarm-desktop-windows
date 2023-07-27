<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alarm extends Model
{
    use HasFactory;

    protected $fillable = [
        'alarm',
        'reminder',
        'time',
        'date',
        'repeat',
        'repeat_times',
        'repeat_unit',
        'is_active',
        'is_completed'
    ];
}
