<?php

namespace Src\modules\catalogs\domain\entities;

use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusActive;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusDescription;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusId;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusName;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusTableHeader;

class GlobalStatus
{
    private readonly ?GlobalStatusId $id;
    private readonly GlobalStatusName $name;
    private readonly GlobalStatusDescription $description;
    private readonly GlobalStatusTableHeader $table_header;
    private readonly GlobalStatusActive $active;

    public function __construct(
        GlobalStatusName $name,
        GlobalStatusDescription $description,
        GlobalStatusTableHeader $table_header,
        GlobalStatusActive $active,
        ?GlobalStatusId $id = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->table_header = $table_header;
        $this->active = $active;
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
    public function getActive(): GlobalStatusActive
    {
        return $this->active;
    }
}
