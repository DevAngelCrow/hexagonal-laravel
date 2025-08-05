<?php

namespace Src\modules\profile\infrastructure\dtos\departmentDtoHttpResponse;

use Src\modules\profile\domain\entities\department\Department;

class DepartmentDtoHttp
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $description,
        public readonly int $id_country,
        public readonly bool $active
    ) {}
    public static function fromEntity(Department $department){
        return new self(
            $department->getId()->value(),
            $department->getName()->value(),
            $department->getDescription()->value(),
            $department->getActive()->value(),
            $department->getIdCountry()->value(),
        );
    }
}
