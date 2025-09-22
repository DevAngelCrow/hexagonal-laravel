<?php

namespace Src\modules\catalogs\application\dtos;

use Src\modules\catalogs\domain\entities\gender\Gender;

class GenderDto
{
    public function __construct(
        public readonly string $name,
        public readonly ?int $id = null
    ) {
    }

    public static function fromEntity(Gender $gender): self
    {
        return new self(
            $gender->getName()->value(),
            $gender->getId()?->value() ?: null
        );
    }

}