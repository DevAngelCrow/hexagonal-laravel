<?php

namespace Src\modules\catalogs\infrastructure\dtos\genterDtoHttpResponse;

use Src\modules\catalogs\domain\entities\gender\Gender;

class GenderDtoHttp
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
    ) {}

    public static function fromEntity(Gender $gender): self
    {
        return new self(
            $gender->getId()->value(),
            $gender->getName()->value()
        );
    }
}