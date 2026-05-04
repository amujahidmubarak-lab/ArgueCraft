<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimulationTopic extends Model
{
    protected $guarded = [];

    protected $casts = [
        'stance_keywords' => 'array',
        'opponent_arguments' => 'array',
        'is_active' => 'boolean',
    ];
}
