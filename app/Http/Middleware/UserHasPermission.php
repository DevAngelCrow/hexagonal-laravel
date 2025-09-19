<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Src\modules\security\application\useCases\security_authorization_port\CheckPermissionUseCase;
use Src\modules\security\application\useCases\security_authorization_port\HasRoleUseCase;
use Symfony\Component\HttpFoundation\Response;

class UserHasPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    private $checkUserPermission;
    private $hasRole;
   public function __construct(/*CheckPermissionUseCase $checkUserPermission*/ HasRoleUseCase $hasRole)
    {
       // $this->checkUserPermission = $checkUserPermission;
       $this->hasRole = $hasRole;
    }

    public function handle(Request $request, Closure $next, string $permission): Response
    {
        
        $hola = $this->hasRole->run(["po la gran puta", "jeje"]);
        dd($hola);
        // if (!$this->checkUserPermission->run($permission)) {
        //     abort(403, 'Unauthorized action.');
        // }

        return $next($request);
    }
}
