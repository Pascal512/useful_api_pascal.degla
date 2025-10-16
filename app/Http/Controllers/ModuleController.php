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
        // $user->modules()->newPivotQuery()
        //     ->where('module_id', $id)
        //     ->update([
        //         'active' => true,
        //         'user_id' => $user->id,
        //         'module_id' => $id,
        //     ]);
        // foreach ($user->modules as $mod) {
        //     if ($mod && $mod->id == $id) {
        //         $mod->pivot->active = true;
        //     }
        // }
        // $user_modules = [];
        // foreach ($user->modules as $mod) {
        //     if ($mod && $mod->id == $id) {
        //         $mod->pivot->active = true;
        //         $user_modules[$mod->id] = [
        //             'active' => true,
        //             'user_id' => $user->id,
        //             'module_id' => $id,
        //         ];
        //     } else {
        //         $user_modules[$mod->id] = [
        //             'active' => $mod->pivot->active,
        //             'user_id' => $user->id,
        //             'module_id' => $mod->id,
        //         ];
        //     }
        // }
        // $user->modules()->sync($user_modules);

        return response()->json([
            'test' => $request->path()
        ], 200);

        return response()->json([
            'message' => 'Module activated'
        ], 200);
    }

    /**
     * Activate a module for the current user
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
        // $user->modules()->newPivotQuery()
        //     ->where('module_id', $id)
        //     ->update([
        //         'active' => false,
        //         'user_id' => $user->id,
        //         'module_id' => $id,
        //     ]);
        // foreach ($user->modules as $mod) {
        //     if ($mod && $mod->id == $id) {
        //         $mod->pivot->active = false;
        //         $user->save();
        //     }
        // }

        // return response()->json([
        //     'test' => $request->user()->modules
        // ], 200);

        return response()->json([
            'message' => 'Module deactivated'
        ], 200);
    }
}
