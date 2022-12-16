<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminMiddleware
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
        if(Auth::check())
        {
            //admin role == 1
            //user role == 2

            $userRole = DB::table('user_roles')
            ->where('user_id', '=', auth()->user()->id)
            ->select('role_id')
            ->get()
            ->first();
            
            if($userRole->role_id == 1) {
                return $next($request);
            }
            else{
                return abort(404);
            }
        }
        else 
        {
            return redirect('/login');
        }
        return $next($request);
    }
}
