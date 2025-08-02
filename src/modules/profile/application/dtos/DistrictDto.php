<?php
namespace Src\modules\profile\application\dtos;

use Src\modules\profile\domain\entities\district\District;

class DistrictDto
{
    public function __construct(
        
        public readonly string $name,
        public readonly string $description,
        public readonly int $id_municipality,
        public readonly bool $state,
        public readonly ?int $id = null,
    ) {}
    public static function fromEntity(District $district){
        return new self(
            
            $district->getName()->value(),
            $district->getDescription()->value(),
            $district->getIdMunicipality()->value(),
            $district->getState()->value(),
            $district->getId()->value() ?: null,
        );
    }
}