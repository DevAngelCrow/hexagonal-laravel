<?php
namespace Src\modules\catalogs\global_status\application\useCases;

use Src\modules\catalogs\global_status\application\dtos\GlobalStatusDto;
use Src\modules\catalogs\global_status\domain\entities\GlobalStatus;
use Src\modules\catalogs\global_status\domain\repositories\GlobalStatusRepositoryInterface;
use Src\modules\catalogs\global_status\domain\value_objects\GlobalStatusId;
use Src\modules\catalogs\global_status\domain\value_objects\GlobalStatusName;
use Src\modules\catalogs\global_status\domain\value_objects\GlobalStatusDescription;
use Src\modules\catalogs\global_status\domain\value_objects\GlobalStatusTableHeader;




use Src\shared\domain\ApplicationException;
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
            id: new GlobalStatusId($globalStatatus->id)
        );

        $this->globalStatusRepository->update($globalStatusUpdate);

    }
}
