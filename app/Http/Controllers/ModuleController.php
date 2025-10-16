<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    /**
     * Show all modules
     */
    public function index()
    {
        return response()->json(Module::all(), 200);
    }

    /**
     * Activate a module for the current user
     */
    public function activate(Request $request, $id)
    {
        $user = $request->user();
        $module = Module::where('id', $id);

        if (!$module) {
            return response()->json([
                'message' => 'Module not found'
            ], 404);
        }

        $user->modules()->updateExistingPivot($id, [
            'active' => true,
        ]);

        return response()->json([
            'message' => 'Module activated'
        ], 200);
    }

    /**
     * Deactivate a module for the current user
     */
    public function deactivate(Request $request, $id)
    {
        $user = $request->user();
        $module = Module::where('id', $id);

        if (!$module) {
            return response()->json([
                'message' => 'Module not found'
            ], 404);
        }
        
        $request->user()->modules()->updateExistingPivot($id, [
            'active' => false,
        ]);

        return response()->json([
            'message' => 'Module deactivated'
        ], 200);
    }
}
