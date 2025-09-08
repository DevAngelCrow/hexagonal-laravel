<?php

namespace Src\modules\catalogs\global_status\application\useCases;

use Src\modules\catalogs\global_status\application\dtos\GlobalStatusDto;
use Src\modules\catalogs\global_status\domain\entities\GlobalStatus;
use Src\modules\catalogs\global_status\domain\repositories\GlobalStatusRepositoryInterface;
// use Src\modules\catalogs\global_status\domain\value_objects\GlobalStatusId;
use Src\modules\catalogs\global_status\domain\value_objects\GlobalStatusName;
use Src\modules\catalogs\global_status\domain\value_objects\GlobalStatusDescription;
use Src\modules\catalogs\global_status\domain\value_objects\GlobalStatusTableHeader;



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
        );
        $this->repository->create($globalStatus);
    }
}

