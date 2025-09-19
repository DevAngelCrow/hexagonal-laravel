<?php
namespace Src\modules\security\domain\ports;


interface SecurityAuthorizationPortInterface {
    public function hasRole(array $role) : bool;
    public function checkPermission(string $permission) : bool;
    // public function assignRole(int $id_role) : void;
    // public function getUserRoles(int $id_user) : array;
}