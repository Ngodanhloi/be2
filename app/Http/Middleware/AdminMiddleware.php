<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
{
    $user = $request->user();

    if (!$user) {
        return redirect('/login');
    }

    // Nếu user role không nằm trong $roles thì xử lý redirect
    if (!in_array($user->role, $roles)) {
        if ($user->role === 'user') {
            return redirect('/profile');  // user chuyển profile
        }

        if ($user->role === 'admin') {
            // Admin truy cập route không được phép => abort hoặc redirect trang admin
            return redirect('/admin'); // admin chuyển về admin nếu truy cập sai trang
        }

        abort(403, 'Unauthorized');
    }

    // Nếu role hợp lệ => tiếp tục request
    return $next($request);
}

}
