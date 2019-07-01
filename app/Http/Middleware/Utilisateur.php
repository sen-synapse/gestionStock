<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
class Utilisateur
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
      if(Auth::user()->niveau == 1)
      {
        Session::flash('info', 'Vous n\'êtes pas autorisé à effectuer cette opération !');

        return redirect()->back();
      }
      return $next($request);
    }
}
