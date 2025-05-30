<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = User::find(Auth::id());

        if (!$user) {
            return redirect()->route('login');
        }
        if (!$user->hasAnyRole($roles)) { 
            abort(403, 'Bạn không có quyền truy cập');
        }


        return $next($request);
    }
}
