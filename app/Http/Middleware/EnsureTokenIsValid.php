<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureTokenIsValid
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
        $auth_token = $request->header('Authorization-token');

        if (!is_null($auth_token)){
            if (!in_array($auth_token, config('app.auth_token'), true)) {
                $response = [
                    'success' => false,
                    'message' => 'Неверный токен. Ошибка авторизации',
                ];

                return response()->json($response, 401);
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Не пришел токен. Неавторизованное устройство',
            ];

            return response()->json($response, 401);
        }

        return $next($request);
    }
}
