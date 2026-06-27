<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_hash',
        'ip',
        'user_agent',
        'path',
        'visited_on',
        'visited_at',
    ];

    protected $casts = [
        'visited_on' => 'date',
        'visited_at' => 'datetime',
    ];
}
