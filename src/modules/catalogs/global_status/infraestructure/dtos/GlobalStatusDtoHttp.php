<?php

namespace Src\modules\catalogs\global_status\infraestructure\dtos;

use Src\modules\catalogs\global_status\domain\entities\GlobalStatus;

class GlobalStatusDtoHttp
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $description,
        public readonly string $table_header,
    ) {}

    public static function fromEntity(GlobalStatus $globalStatus){
        //dd($address);
        return new self(
            id: $globalStatus->getId()->value(),
            name: $globalStatus->getName()->value(),
            description: $globalStatus->getDescription()->value(),
            table_header: $globalStatus->getTableHeader()->value(),
        );
    }
}
