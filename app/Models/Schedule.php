<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'day', 'morning_start', 'morning_end', 'afternoon_start', 'afternoon_end'];

    protected $casts = [
        'day' => 'array', // Converts JSON to array
    ];
}
