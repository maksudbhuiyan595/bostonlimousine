<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;

class AddTrailingSlash
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('get')) {
            $path = $request->getPathInfo();
            if ($path != '/' && !str_ends_with($path, '/') && !str_contains(basename($path), '.')) {

                $newUrl = rtrim($request->root(), '/') . $path . '/';

                if ($request->getQueryString()) {
                    $newUrl .= '?' . $request->getQueryString();
                }

                return Redirect::to($newUrl, 301);
            }
        }
        return $next($request);
    }
}
