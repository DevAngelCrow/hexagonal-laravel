<?php

namespace Src\modules\security\infrastructure\dtos\userRoleDtoHttpReponse;

use Src\modules\security\domain\entities\user_role\UserRole;

class UserRoleDtoHttp {
    public function __construct(
        public readonly int $id_user,
        public readonly ?array  $role_ids = null,
        public readonly ?int $id = null
    )
    {}

   public static function fromEntity(UserRole $userRoles) : self {

        return new self(
            $userRoles->getIdUser()->value(),
            $userRoles->getIdRol() ? : null,
            $userRoles->getId()->value() ?: null
        );
    }
}