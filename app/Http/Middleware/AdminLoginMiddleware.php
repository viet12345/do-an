<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
use Cookie;
class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Cookie::has('admin_id')){

            return $next($request);
        }
        else{
            return redirect('dangnhap')->with(['alert-type' => 'error', 'message' =>'Bạn cần có tài khoản Admin']);
        }
    }
}
