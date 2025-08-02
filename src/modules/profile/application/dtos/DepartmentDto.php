<?php

namespace Src\modules\profile\application\dtos;

use Src\modules\profile\domain\entities\department\Department;

class DepartmentDto
{
    public function __construct(

        public readonly string $name,
        public readonly string $description,
        public readonly int $id_country,
        public readonly ?int $id = null,
    ) {}
    public static function fromEntity(Department $department)
    {
        return new self(

            $department->getName()->value(),
            $department->getDescription()->value(),
            $department->getIdCountry()->value(),
            $department->getId()->value() ?: null,
        );
    }
}
