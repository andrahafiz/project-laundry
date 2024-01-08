<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $roles = array_slice(func_get_args(), 2);
        $user  = auth()->user()->roles;
        foreach ($roles as $role) {
            // dd($user, $roles);
            $user = auth()->user()->roles;
            if ($user == $role) {
                return $next($request);
            }
        }

        // return redirect("not-access")->withSuccess('You are not allowed to access');
        abort(403);
    }
}
