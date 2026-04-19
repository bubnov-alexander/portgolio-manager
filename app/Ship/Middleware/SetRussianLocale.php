<?php

namespace App\Ship\Middleware;

use App\Ship\Parents\Middleware\Middleware as ParentMiddleware;
use Carbon\Carbon;
use Illuminate\Http\Request;

final class SetRussianLocale extends ParentMiddleware
{
    /**
     * @param \Closure(Request): mixed $next
     */
    public function handle(Request $request, \Closure $next): mixed
    {
        app()->setLocale('ru');
        Carbon::setLocale('ru');

        return $next($request);
    }
}
