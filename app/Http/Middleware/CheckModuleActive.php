<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckModuleActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $user = $request->user();
        $user = Auth::user();
        // return response()->json([
        //     'test' => $user
        // ], 200);

        // Determine which module the request wants to access
        $module = 0;
        // Module 1
        if (
            $request->path() == "/api/shorten"
            || str_contains($request->path(), "/api/s/")
            || $request->path() == "/api/links"
            || str_contains($request->path(), "/api/links/")
        ) {
            $module = 1;
        }
        // Module 2
        if (
            $request->path() == "/api/wallet"
            || $request->path() == "/api/wallet/transfer"
            || $request->path() == "/api/wallet/topup"
            || $request->path() == "/api/wallet/transactions"
        ) {
            $module = 2;
        }
        // Module 3
        if (
            $request->path() == "/api/products"
            || $request->path() == "/api/orders"
            || str_contains($request->path(), "/api/products/")
        ) {
            $module = 3;
        }
        // Module 4
        if (
            $request->path() == "/api/sessions/start"
            || $request->path() == "/api/sessions/stop"
            || $request->path() == "/api/sessions"
            || str_contains($request->path(), "/api/sessions/")
            || $request->path() == "/api/sessions/analytics"
        ) {
            $module = 4;
        }
        // Module 5
        if (
            $request->path() == "/api/assets"
            || str_contains($request->path(), "/api/assets/")
            || $request->path() == "/api/investments/buy"
            || $request->path() == "/api/investments/sell"
            || $request->path() == "/api/portfolio"
            || $request->path() == "/api/transactions"
        ) {
            $module = 5;
        }

        // Check if the module is activated
        foreach ($user->modules as $user_mod) {
            if ($user_mod->id == $module && !$user_mod->pivot->active) {
                return response()->json([
                    'error' => 'Module inactive. Please activate this module to use it.'
                ], 403);
            }
        }
        
        return $next($request);
    }
}
