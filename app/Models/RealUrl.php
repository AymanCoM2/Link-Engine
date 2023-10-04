<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealUrl extends Model
{
    use HasFactory;

    protected $fillable  = [
        'url_host',
        'state',
        'isActive',
        'security',
        'favIcon',
        'stateForSchedule'
    ];
}
