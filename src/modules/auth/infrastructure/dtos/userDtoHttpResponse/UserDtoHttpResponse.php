<?php
namespace Src\modules\auth\infrastructure\dtos\userDtoHttpResponse;

use Src\modules\auth\domain\entities\user\User;

class UserDtoHttpResponse
{
    public function __construct(
        public readonly int $id,
        public readonly string $user_name,
        public readonly int $id_status,
        public readonly bool $is_validated,
    ) {}

    public static function fromEntity(User $user){
        
        return new self(
            $user->getId()->value(),
            $user->getUserName()->value(),
            $user->getIdStatus()->value(),
            $user->getIsValidated()->value(),
        );
    }
}
