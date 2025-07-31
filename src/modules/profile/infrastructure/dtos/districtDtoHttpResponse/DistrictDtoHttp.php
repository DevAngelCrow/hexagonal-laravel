<?php

namespace Src\modules\profile\infrastructure\dtos\districtDtoHttpResponse;

use Src\modules\profile\domain\entities\district\District;

class DistrictDtoHttp
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $description,
        public readonly int $id_municipality,
        public readonly bool $state
    ) {}
    public static function fromEntity(District $district){
        return new self(
            $district->getId()->value(),
            $district->getName()->value(),
            $district->getDescription()->value(),
            $district->getIdMunicipality()->value(),
            $district->getState()->value()
        );
    }
}