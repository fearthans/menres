<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) { // Check if the user is authenticated
            $user = Auth::user(); // Get the authenticated user

            // Redirect based on the user's role
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.roles'); // Redirect to admin roles page
            } elseif ($user->hasRole('risk_owner')) {
                return redirect()->route('risk.owner.dashboard'); // Redirect to risk owner's dashboard
            } elseif ($user->hasRole('operator')) {
                return redirect()->route('operator.asset.categories'); // Redirect to operator categories
            } elseif ($user->hasRole('kepala_upt')) {
                return redirect()->route('kepala.upt.risk.profile'); // Redirect to Kepala UP profile
            }

            // Default redirect if no role matched
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request); // Continue with the request if not authenticated
    }
}
