<?php

namespace Src\modules\catalogs\global_status\domain\entities;

use Src\modules\catalogs\global_status\domain\value_objects\GlobalStatusId;
use Src\modules\catalogs\global_status\domain\value_objects\GlobalStatusName;
use Src\modules\catalogs\global_status\domain\value_objects\GlobalStatusDescription;
use Src\modules\catalogs\global_status\domain\value_objects\GlobalStatusTableHeader;



class GlobalStatus
{
    private readonly ?GlobalStatusId $id;
    private readonly GlobalStatusName $name;
    private readonly GlobalStatusDescription $description;
    private readonly GlobalStatusTableHeader $table_header;

    public function __construct(
        GlobalStatusName $name,
        GlobalStatusDescription $description,
        GlobalStatusTableHeader $table_header,
        ?GlobalStatusId $id = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->table_header = $table_header;
    }

    public function getId(): ?GlobalStatusId
    {
        return $this->id;
    }

    public function getName(): GlobalStatusName
    {
        return $this->name;
    }

    public function getDescription(): GlobalStatusDescription
    {
        return $this->description;
    }

    public function getTableHeader(): GlobalStatusTableHeader
    {
        return $this->table_header;
    }
}
