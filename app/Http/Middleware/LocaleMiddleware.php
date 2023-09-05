<?php

namespace App\Http\Middleware;

use Closure;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Class LocaleMiddleware.
 */
class LocaleMiddleware
{
    /**
     * @param         $request
     * @param Closure $next
     *
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function handle($request, Closure $next): mixed
    {
        if (config('base.locale.status') && session()->has('locale')) {
            setAllLocale(session()->get('locale'));
        }

        return $next($request);
    }
}
