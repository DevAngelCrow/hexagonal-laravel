<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Src\modules\security\application\useCases\security_authorization_port\CheckPermissionUseCase;
use Src\shared\infrastructure\exceptions\InfrastructureException;
use Symfony\Component\HttpFoundation\Response;
use Src\shared\infrastructure\HttpResponses;
class UserHasPermission
{
    use HttpResponses;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    private $checkPermission;
    public function __construct(CheckPermissionUseCase $checkUserPermission)
    {
        $this->checkPermission = $checkUserPermission;
        //$this->hasRole = $hasRole;
    }

    public function handle(Request $request, Closure $next, string $permission): Response
    {

        $prueba = $this->checkPermission->run($permission);
        
        if(!$prueba){
            return $this->unauthorized("No autorizado");
        }

        return $next($request);
    }
}
