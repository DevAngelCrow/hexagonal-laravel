<?php

namespace Src\modules\profile\application\dtos;

use Src\modules\profile\domain\entities\gender\Gender;

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