<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SentryContext
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (app()->bound('sentry') && Auth::check()) {
            $user = Auth::user();

            if ($user instanceof \App\Models\User) {
                \Sentry\configureScope(function (\Sentry\State\Scope $scope) use ($user): void {
                    $scope->setUser([
                        'id'    => $user->id,
                        'email' => $user->email,
                        'role'  => $user->roles->first()?->name,
                    ]);
                });
            }
        }

        return $next($request);
    }
}
