<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
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
         
         
        
        
        if (!isset(auth()->user()->email) && ($request->path() !='/user' && $request->path() !='/register' && $request->path() !='/welcome' && $request->path() !='/admin')) {
            return redirect('/user')->with('error', 'You must be logged in');
        }

     /*  if(session()->has('LoggedUser') && ($request->path() == '/user' || $request->path() == '/register' ) ){
            return back();
        }*/
        
        return $next($request)->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
                              ->header('Pragma', 'no-cache');
    }
}
