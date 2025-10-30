<?php

namespace Src\modules\catalogs\application\dtos;

use Src\modules\catalogs\domain\entities\department\Department;

class DepartmentDto
{
    public function __construct(

        public readonly string $name,
        public readonly string $description,
        public readonly int $id_country,
        public readonly ?bool $active = null,
        public readonly ?int $id = null,
    ) {}
    public static function fromEntity(Department $department)
    {
        return new self(
            $department->getName()->value(),
            $department->getDescription()->value(),
            $department->getIdCountry()->value(),
            $department->getActive()->value() ?: null,
            $department->getId()->value() ?: null,
        );
    }
}
