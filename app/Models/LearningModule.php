<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningModule extends Model
{
    protected $guarded = [];

    protected $casts = [
        'sections' => 'array',
    ];
}
