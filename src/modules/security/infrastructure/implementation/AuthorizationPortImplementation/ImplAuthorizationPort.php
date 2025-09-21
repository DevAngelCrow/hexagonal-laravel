<?php

namespace Src\modules\security\infrastructure\implementation\AuthorizationPortImplementation;

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

        var_dump($user);
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
}
