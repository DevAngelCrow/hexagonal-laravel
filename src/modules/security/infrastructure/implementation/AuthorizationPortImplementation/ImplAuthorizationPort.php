<?php
namespace Src\modules\security\infrastructure\implementation\AuthorizationPortImplementation;

use Illuminate\Support\Facades\Auth;
use Src\modules\security\domain\ports\SecurityAuthorizationPortInterface;

class ImplAuthorizationPort implements SecurityAuthorizationPortInterface{

    public function hasRole(array $role): bool
    {
        $user = Auth::user();

        var_dump($user);
        if(!$user){
            return false;
        }

     
        $roles = $user->id;

        return false;
    }
    public function checkPermission(string $permission): bool
    {
        return true;
    }
}