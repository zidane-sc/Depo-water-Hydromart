<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckPrivilege
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $privilege)
    {
        // Cek jika departement tidak terdaftar
        if ($request->user()->hasPrivilege($privilege) === 403) {
            Auth::logout();
            return redirect('login')->with(['validate' => 'Departement doest exist ']);
        }

        if (Auth::user()->departement->name == 'ROOT') {
            return $next($request);
        }

        if (!$request->user()->hasPrivilege($privilege)) {
            // abort(401, 'This action is unauthorized.');
            // return false;
            return redirect()->back()->with(['privilege' => 'Access Denied ! ']);

        }

        return $next($request);
    }
}
