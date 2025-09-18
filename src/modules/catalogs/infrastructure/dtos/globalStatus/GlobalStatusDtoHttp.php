<?php
namespace Src\modules\catalogs\infrastructure\dtos\globalStatus;

use Src\modules\catalogs\domain\entities\GlobalStatus;

class GlobalStatusDtoHttp
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $description,
        public readonly string $table_header,
        public readonly bool $active,
    ) {}

    public static function fromEntity(GlobalStatus $globalStatus){
        return new self(
            id: $globalStatus->getId()->value(),
            name: $globalStatus->getName()->value(),
            description: $globalStatus->getDescription()->value(),
            table_header: $globalStatus->getTableHeader()->value(),
            active: $globalStatus->getActive()->value(),
        );
    }
}
