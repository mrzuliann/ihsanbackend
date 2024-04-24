<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = $request->user();

        // Periksa apakah pengguna memiliki role yang diizinkan
        if ($user && in_array($user->role_id, $roles)) {
            return $next($request);
        }

         // Jika pengguna tidak terautentikasi, tetapi memiliki role yang diizinkan
        if (!$user && in_array('guest', $roles)) {
            return $next($request);
        }
        abort(403, 'Unauthorized');
        return back('/');
    }
}
