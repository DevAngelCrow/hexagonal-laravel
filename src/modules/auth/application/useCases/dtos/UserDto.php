<?php
namespace Src\modules\auth\application\useCases\dtos;

use DateTimeImmutable;
use Src\modules\auth\domain\entities\user\User;

class UserDto {

    public function __construct(
        public readonly int $id_people,
        public readonly string $user_name,
        public readonly string $password,
        public readonly int $id_status,
        public readonly DateTimeImmutable $last_access,
        public readonly bool $is_validated,
        public readonly ?int $id = null){     
    }

    public static function fromEntity(User $user): self {
        return new self(
            $user->getIdPeople()->value(),
            $user->getUserName()->value(),
            $user->getPassword()->value(),
            $user->getIdStatus()->value(),
            $user->getLastAccess()->value(),
            $user->getIsValidated()->value(),
            $user->getId()->value() ?: null,
        );
    }
}