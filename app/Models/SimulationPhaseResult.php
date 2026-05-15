<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulationPhaseResult extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function simulationResult()
    {
        return $this->belongsTo(SimulationResult::class);
    }
}
