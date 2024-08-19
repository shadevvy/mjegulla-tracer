<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traffic extends Model
{
    use HasFactory;

    protected $table = 'traffics';

    protected $fillable = [
        'site_id',
        'user_ip',
        'website_url',
        'website_title',
        'country',
        'device',
        'user_agent',
        'browser',
    ];
}
