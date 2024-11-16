<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        // Check the user's role and redirect accordingly
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.roles'); // Redirect to admin roles page
        } elseif ($user->hasRole('risk_owner')) {
            return redirect()->route('risk.owner.dashboard'); // Redirect to risk owner dashboard
        } elseif ($user->hasRole('operator')) {
            return redirect()->route('operator.asset.categories'); // Redirect to operator asset categories
        } elseif ($user->hasRole('kepala_upt')) {
            return redirect()->route('kepala.upt.risk.profile'); // Redirect to Kepala UP profile
        }

        // If none of the roles match, continue with the request
        return $next($request);
    }
}
