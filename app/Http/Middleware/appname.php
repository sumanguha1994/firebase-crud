<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class appname
{
    public function handle($request, Closure $next)
    {
        if(\Session::has('appname')){
            return $next($request);
        }else{
            return redirect()->back();
        }
    }
}
