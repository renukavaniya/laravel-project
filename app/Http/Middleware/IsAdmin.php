<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       // if(auth()->user()->is_admin==1)
        if (auth()->check() && auth()->user()->is_admin == 1) {
            return $next($request);
        }
        return redirect('welcome')->with('error', 'you dont have access to admin');
        // return back()->with('error', 'you dont have access to admin');*/
        
        if (!isset(auth()->user()->email) &&  ($request->path() !='/admin')) {
            return redirect('/admin')->with('error', 'You must be logged in');
        }
          return $next($request)->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
                              ->header('Pragma', 'no-cache');
        

         
      /* if(session()->has('AdminUser') && ($request->path() == '/admin' ) ){
            return back();
        }*/
    }
}
