<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\SimulationResult;
use App\Models\InteractiveSession;
use Illuminate\Support\Facades\Auth;

class ExportController extends Controller
{
    public function exportStandard($id)
    {
        $result = SimulationResult::with(['topic', 'phaseResults'])->findOrFail($id);
        
        if ($result->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403);
        }

        $pdf = Pdf::loadView('exports.standard_result', ['result' => $result]);
        return $pdf->download('ArgueCraft_Laporan_Simulasi_' . $result->id . '.pdf');
    }

    public function exportInteractive($id)
    {
        $session = InteractiveSession::with(['topic', 'messages'])->findOrFail($id);
        
        if ($session->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403);
        }

        $pdf = Pdf::loadView('exports.interactive_result', ['session' => $session]);
        return $pdf->download('ArgueCraft_Laporan_Interaktif_' . $session->id . '.pdf');
    }
}
