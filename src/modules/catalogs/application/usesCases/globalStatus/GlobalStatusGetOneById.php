<?php
namespace Src\modules\catalogs\application\usesCases\globalStatus;

use Src\modules\catalogs\domain\entities\GlobalStatus;
use Src\modules\catalogs\domain\repositories\GlobalStatusRepositoryInterface;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusId;

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
