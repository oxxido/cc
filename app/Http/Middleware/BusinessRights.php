<?php namespace App\Http\Middleware;

use Auth;
use Closure;
use Redirect;

class BusinessRights
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
        if (!$request->biz->hasRights(Auth::user())) {
            if ($request->ajax())
                return response('Unauthorized.', 401);
            else
                return Redirect::to('dashowner/business')->with('message', 'You are not allowed there.');
        }

        return $next($request);
    }
}
