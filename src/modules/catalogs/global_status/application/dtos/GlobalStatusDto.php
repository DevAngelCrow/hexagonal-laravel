<?php

namespace Src\modules\catalogs\global_status\application\dtos;

use DateTime;

use Src\modules\catalogs\global_status\domain\entities\GlobalStatus;

class GlobalStatusDto
{
    public function __construct(

        public readonly string $table_header,
        public readonly string $name,
        public readonly string $description,
        public readonly ?int $id = null,
    ) {}
    public static function fromEntity(GlobalStatus $globalStatus)
    {
        return new self(

            table_header: $globalStatus->getTableHeader()->value(),
            name: $globalStatus->getName()->value(),
            description: $globalStatus->getDescription()->value(),
            id: $globalStatus->getId()->value() ?: null,
        );
    }
}
