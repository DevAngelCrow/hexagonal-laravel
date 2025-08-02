<?php
namespace Src\modules\profile\application\dtos;

use Src\modules\profile\domain\entities\municipality\Municipality;

class MunicipalityDtoHttp
{
    public function __construct(
        
        public readonly string $name,
        public readonly string $description,
        public readonly int $id_department,
        public readonly ?int $id = null,
    ) {}
    public static function fromEntity(Municipality $municipality){
        return new self(
            
            $municipality->getName()->value(),
            $municipality->getDescription()->value(),
            $municipality->getIdDepartment()->value(),
            $municipality->getId()->value() ?: null,
        );
    }
}