<?php

namespace App\Http\Middleware;

use Closure;
use App\traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CheckLanguage
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
        if(!in_array($request->header('accept-language'),config('app.supported_languages'))){
            return ApiTrait::errorMessage(['accept-language'=>'Missed Key'],'Please Send a Supported Language ('.implode(',',config('app.supported_languages')).')',400);
        }
        App::setLocale($request->header('accept-language'));
        return $next($request);
    }
}
