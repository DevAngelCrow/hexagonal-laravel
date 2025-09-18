<?php
namespace Src\modules\catalogs\application\dtos;

use DateTime;
use Src\modules\catalogs\domain\entities\GlobalStatus;

class GlobalStatusDto
{
    public function __construct(

        public readonly string $table_header,
        public readonly string $name,
        public readonly string $description,
        public readonly bool $active,
        public readonly ?int $id = null,
    ) {}
    public static function fromEntity(GlobalStatus $globalStatus)
    {
        return new self(

            table_header: $globalStatus->getTableHeader()->value(),
            name: $globalStatus->getName()->value(),
            description: $globalStatus->getDescription()->value(),
            active: $globalStatus->getActive()->value(),
            id: $globalStatus->getId()->value() ?: null,
        );
    }
}
