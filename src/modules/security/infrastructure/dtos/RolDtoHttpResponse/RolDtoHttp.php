<?php

namespace Src\modules\security\infrastructure\dtos\RolDtoHttpResponse;

use Src\modules\security\domain\entities\rol\Rol;

class RolDtoHttp
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly int $id_status,
        public readonly ?int $id = null
    ) {}

    public static function fromEntity(Rol $rol): self
    {
        return new self(
            $rol->getName()->value(),
            $rol->getDescription()->value(),
            $rol->getIdStatus()->value(),
            $rol->getId()->value() ?: null
        );
    }
}
