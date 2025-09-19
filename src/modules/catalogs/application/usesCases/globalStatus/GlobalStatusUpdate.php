<?php
namespace Src\modules\catalogs\application\usesCases\globalStatus;

use Src\modules\catalogs\application\dtos\GlobalStatusDto;
use Src\modules\catalogs\domain\entities\GlobalStatus;
use Src\modules\catalogs\domain\repositories\GlobalStatusRepositoryInterface;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusActive;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusDescription;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusId;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusName;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusTableHeader;
use Src\shared\application\exceptions\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class GlobalStatusUpdate {
    private readonly GlobalStatusRepositoryInterface $globalStatusRepository;

    public function __construct(GlobalStatusRepositoryInterface $globalStatus_repository)
    {
        $this->globalStatusRepository = $globalStatus_repository;
    }

    public function run(GlobalStatusDto $globalStatatus) : void {

        $idGlobalStatus = new GlobalStatusId($globalStatatus->id);

        $globalStatusDb =  $this->globalStatusRepository->getOneById($idGlobalStatus);

        if(!$globalStatusDb){
            throw new ApplicationException("Identificador de dirección no encontrado", HttpStatusCode::HTTP_NOT_FOUND->value);
        }

        $globalStatusUpdate = new GlobalStatus(
            name: new GlobalStatusName($globalStatatus->name),
            description: new GlobalStatusDescription($globalStatatus->description),
            table_header: new GlobalStatusTableHeader($globalStatatus->table_header),
            active: new GlobalStatusActive($globalStatatus->active),
            id: new GlobalStatusId($globalStatatus->id)
        );

        $this->globalStatusRepository->update($globalStatusUpdate);

    }
}
