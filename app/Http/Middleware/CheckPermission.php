<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $user = $request->user();

        if(!$user){
            return response()->json(["message"=>"Unauthenticated."], 401);
        }

        $permissions = $user->permissions();

        $hasPermission = $permissions->contains("name", $permission);

        if(!$hasPermission){
            return response()->json(["message"=>"Forbidden. No tiene permisos."], 403);
        }

        
        return $next($request);
    }
}
