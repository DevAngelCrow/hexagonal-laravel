<?php
namespace Src\modules\catalogs\application\usesCases\globalStatus;

use Src\modules\catalogs\domain\repositories\GlobalStatusRepositoryInterface;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusId;
use Src\shared\application\exceptions\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class GlobalStatusDelete {
    private readonly GlobalStatusRepositoryInterface $globalStatusRepository;

    public function __construct(GlobalStatusRepositoryInterface $global_status_repository)
    {
        $this->globalStatusRepository = $global_status_repository;
    }

    public function run(int $id) : void {
        $globalStatus = $this->globalStatusRepository->getOneById(new GlobalStatusId($id));

        if(!$globalStatus){
            throw new ApplicationException("Identificador de dirección no encontrado", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }

        $this->globalStatusRepository->delete($globalStatus->getId());
    }
}
