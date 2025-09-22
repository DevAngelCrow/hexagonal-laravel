<?php
namespace Src\modules\security\domain\ports;


interface SecurityAuthorizationPortInterface {
    public function hasRole(array $role) : bool;
    public function checkPermission(string $permission) : bool;
    public function filterRoutesForUser(int $id_user) : array;
}