<?php

namespace Src\modules\profile\infrastructure\dtos\municipalityDtoHttpResponse;

use Src\modules\profile\domain\entities\municipality\Municipality;

class MunicipalityDtoHttp
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $description,
        public readonly int $id_department,
    ) {}
    public static function fromEntity(Municipality $municipality){
        return new self(
            $municipality->getId()->value(),
            $municipality->getName()->value(),
            $municipality->getDescription()->value(),
            $municipality->getIdDepartment()->value(),
        );
    }
}