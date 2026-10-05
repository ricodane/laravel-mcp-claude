<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    // The tool calls ->toDateString() on this
    protected $casts = [
        'arrived_at' => 'date',
    ];
}
