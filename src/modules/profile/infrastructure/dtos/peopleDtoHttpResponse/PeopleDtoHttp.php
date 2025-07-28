<?php

namespace Src\modules\profile\infrastructure\dtos\peopleDtoHttpResponse;

use Src\modules\profile\domain\entities\people\People;

class PeopleDtoHttp
{
    public function __construct(
        public readonly int $id,
        public readonly string $first_name,
        public readonly string $middle_name,
        public readonly string $last_name,
        public readonly string $birthdate,
        public readonly string $email,
        public readonly int $id_gender,
        public readonly int $id_marital_status,
        public readonly string $phone,
        public readonly string $img_path,
        public readonly int $id_status,
    ) {}

    public static function fromEntity(People $people):self{
        return new self(
            $people->getId()->value(),
            $people->getFirstName()->value(),
            $people->getMiddleName()->value(),
            $people->getLastName()->value(),
            $people->getBirthdate()->value()->format('Y-m-d'),
            $people->getEmail()->value(),
            $people->getIdGender()->value(),
            $people->getIdMaritalStatus()->value(),
            $people->getPhone()->value(),
            $people->getImgPath()->value(),
            $people->getIdStatus()->value(),
        );
    }
}
