<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SayCheeseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Should return the result of the next middleware or a http response

//        dump('SAY CHEESE');
        return $next($request);

//        return new JsonResponse([
//            'data' => 'cheese'
//        ]);
    }

    public function terminate($request, $response) {
        dump('bye cheese');
    }
}
