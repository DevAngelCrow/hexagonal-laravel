<?php

namespace Src\modules\security\infrastructure\implementation\AuthorizationPortImplementation;

use App\Models\MntRoute;
use Exception;
use Illuminate\Support\Facades\Auth;
use Src\modules\security\domain\ports\SecurityAuthorizationPortInterface;
use Src\shared\infrastructure\exceptions\InfrastructureException;
use Src\shared\infrastructure\HttpResponses;
use Symfony\Component\HttpFoundation\Response;

class ImplAuthorizationPort implements SecurityAuthorizationPortInterface
{

    use HttpResponses;
    
    public function hasRole(array $role): bool
    {
        $user = Auth::user();

        if (!$user) {
            return false;
        }


        $roles = $user->id;

        return false;
    }
    public function checkPermission(string $permission): bool
    {
        try {
            $user = Auth::user();
            /**@var \App\Models\MntUser $user */
            $permmisionCollection = $user->permissions();

            if (!$user) {
                throw new InfrastructureException("No autorizado", Response::HTTP_UNAUTHORIZED);

                return false;
            }


            return $permmisionCollection->contains(fn($perm) => $perm->name === $permission);
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function filterRoutesForUser(): array
    {
        try {
            $user = Auth::user();

            if (!$user) {
                throw new InfrastructureException("No autorizado", Response::HTTP_UNAUTHORIZED);
            }

            /**@var \App\Models\MntUser $user */
            $permissionsIds = $user->permissions()->pluck('id')->all();

            $routes = MntRoute::whereHas('permissions', function ($q) use ($permissionsIds) {
                $q->whereIn('ctl_permissions.id', $permissionsIds);
            })
                ->with(['children', 'parent'])
                ->get()
                ->unique('id')
                ->values();

            return $routes->toArray();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
