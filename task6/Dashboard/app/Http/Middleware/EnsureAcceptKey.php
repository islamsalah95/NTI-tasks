<?php

namespace App\Http\Middleware;

use Closure;
use App\traits\ApiTrait;
use Illuminate\Http\Request;

class EnsureAcceptKey
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
        if($request->header('accept') !== 'application/json'){
            return ApiTrait::errorMessage(['accept'=>'Missed Key in headers'],"Accept:Application/json");
        }
        return $next($request);
    }
}
