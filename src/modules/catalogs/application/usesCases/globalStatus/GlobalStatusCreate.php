<?php

namespace Src\modules\catalogs\application\usesCases\globalStatus;

use Src\modules\catalogs\application\dtos\GlobalStatusDto;
use Src\modules\catalogs\domain\entities\GlobalStatus;
use Src\modules\catalogs\domain\repositories\GlobalStatusRepositoryInterface;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusActive;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusDescription;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusName;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusTableHeader;

class GlobalStatusCreate {
    private GlobalStatusRepositoryInterface $repository;

    public function __construct(
        GlobalStatusRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }

    public function run(
        GlobalStatusDto $globalStatus
    ): void {
        $globalStatus = new GlobalStatus(
            name: new GlobalStatusName($globalStatus->name),
            description: new GlobalStatusDescription($globalStatus->description),
            table_header: new GlobalStatusTableHeader($globalStatus->table_header),
            active: new GlobalStatusActive($globalStatus->active),
        );
        $this->repository->create($globalStatus);
    }
}

