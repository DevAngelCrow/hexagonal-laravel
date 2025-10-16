<?php
namespace Src\modules\catalogs\application\dtos;

use Src\modules\catalogs\domain\entities\municipality\Municipality;

class MunicipalityDto
{
    public function __construct(
        
        public readonly string $name,
        public readonly string $description,
        public readonly int $id_department,
        public readonly ?bool $active = null,
        public readonly ?int $id = null,
    ) {}
    public static function fromEntity(Municipality $municipality){
        return new self(
            
            $municipality->getName()->value(),
            $municipality->getDescription()->value(),
            $municipality->getIdDepartment()->value(),
            $municipality->getActive()->value() ?: null,
            $municipality->getId()->value() ?: null,
        );
    }
}