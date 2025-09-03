<?php

namespace Src\modules\auth\application\useCases\dtos;

use DateTimeImmutable;

class RegisterDto
{
    public function __construct(
        public readonly string $first_name,
        public readonly string $middle_name,
        public readonly string $last_name,
        public readonly DateTimeImmutable $birthdate,
        public readonly string $email,
        public readonly int $id_gender,
        public readonly int $id_marital_status,
        public readonly string $phone,
        public readonly int $id_status,
        public readonly ?array $nationalities = null,
        public readonly mixed $fileImg,
        public readonly ?int $idPeople = null,
        
        //user
        public readonly string $user_name,
        public readonly string $password,
        public readonly int $id_status_user,
        public readonly DateTimeImmutable $last_access,
        public readonly bool $is_validated,
        public readonly ?int $idUser = null,

        //address
        public readonly string $street,
        public readonly string $street_number,
        public readonly string $neighborhood,
        public readonly int $id_district,
        public readonly string $house_number,
        public readonly string $block,
        public readonly string $pathway,
        public readonly bool $current,
        public readonly ?int $idAddress = null,

        //document
        public readonly int $id_type_document,
        public readonly string $description,
        public readonly string $document_number,
        public readonly bool $active,
        public readonly ?int $idDocument = null
    ) {}
}
