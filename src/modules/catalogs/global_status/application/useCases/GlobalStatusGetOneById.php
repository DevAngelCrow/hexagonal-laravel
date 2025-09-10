<?php
namespace Src\modules\catalogs\global_status\application\useCases;

use Src\modules\catalogs\global_status\domain\entities\GlobalStatus;
use Src\modules\catalogs\global_status\domain\repositories\GlobalStatusRepositoryInterface;
use Src\modules\catalogs\global_status\domain\value_objects\GlobalStatusId;

class GlobalStatusGetOneById {
    private readonly GlobalStatusRepositoryInterface $globalStatusRepository;

    public function __construct(GlobalStatusRepositoryInterface $globalStatus_repository)
    {
        $this->globalStatusRepository = $globalStatus_repository;
    }

    public function run (int $id) : GlobalStatus {

        return $this->globalStatusRepository->getOneById(new GlobalStatusId($id));

    }
}
