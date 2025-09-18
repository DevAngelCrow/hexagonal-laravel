<?php

namespace Src\modules\catalogs\application\dtos;

use Src\modules\catalogs\domain\entities\MaritalStatusEntity;

class CreateMaritalDto
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $description,

    ) {}

    public static function fromEntity(MaritalStatusEntity $entity): self
    {
        return new self(
            name: $entity->getName()->value(),
            description: $entity->getDescription()->value(),
        );
    }
}
