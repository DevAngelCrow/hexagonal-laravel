<?php
namespace Src\modules\auth\domain\ports;

use Src\modules\auth\domain\entities\user\User;

interface ValidateTokenPortInterface {
    public function validateToken(string $token): ?User;
    public function isTokenExpired(string $token) : bool;
    public function getAuthenticatedUser(): ?User;
}