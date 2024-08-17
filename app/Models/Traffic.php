<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traffic extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'user_ip',
        'country',
        'device',
        'user_agent',
    ];
}
