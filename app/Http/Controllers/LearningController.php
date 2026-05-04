<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LearningModule;

class LearningController extends Controller
{
    public function index()
    {
        $modules = LearningModule::all();
        $completedModules = session('completed_modules', []);

        return view('learning.index', compact('modules', 'completedModules'));
    }

    public function show(LearningModule $module)
    {
        $completedModules = session('completed_modules', []);
        $isCompleted = in_array($module->id, $completedModules);

        return view('learning.show', compact('module', 'isCompleted'));
    }

    public function complete(Request $request, LearningModule $module)
    {
        $completedModules = session('completed_modules', []);
        
        if (!in_array($module->id, $completedModules)) {
            $completedModules[] = $module->id;
            session(['completed_modules' => $completedModules]);
        }

        return redirect()->route('learning.index')->with('success', 'Selamat! Anda telah menyelesaikan modul ' . $module->title);
    }
}
