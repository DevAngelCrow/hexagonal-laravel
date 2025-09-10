<?php

namespace Src\modules\catalogs\global_status\infraestructure\implementation;

use LogicException;
use Src\modules\catalogs\global_status\domain\entities\GlobalStatus;
use Src\modules\catalogs\global_status\domain\repositories\GlobalStatusRepositoryInterface;
use Src\modules\catalogs\global_status\domain\value_objects\GlobalStatusId;
use App\Models\CtlGlobalStatus as GlobalStatusModel;
use ErrorException;
use Exception;
use Src\modules\catalogs\global_status\domain\value_objects\GlobalStatusName;
use Src\modules\catalogs\global_status\domain\value_objects\GlobalStatusDescription;
use Src\modules\catalogs\global_status\domain\value_objects\GlobalStatusTableHeader;


use Src\shared\infrastructure\exceptions\InfrastructureException;
use Symfony\Component\HttpFoundation\Response;


class ImplGlobalStatusRepository implements GlobalStatusRepositoryInterface
{
    private array $globalStatusArray = [];
    public function create(GlobalStatus $globalStatus): void
    {
        try {
            $globalStatusModel = new GlobalStatusModel;

            $globalStatusModel->name = $globalStatus->getName()->value();
            $globalStatusModel->description = $globalStatus->getDescription()->value();
            $globalStatusModel->table_header = $globalStatus->getTableHeader()->value();
            $globalStatusModel->save();
        } catch (ErrorException $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update(GlobalStatus $documentType): void
    {
        try {

            $documentTypeModel = GlobalStatusModel::find($documentType->getId()->value());

            $documentTypeModel->name = $documentType->getName()->value();
            $documentTypeModel->description = $documentType->getDescription()->value();
            $documentTypeModel->table_header = $documentType->getTableHeader()->value();
            $documentTypeModel->save();
        } catch (ErrorException $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getAll(?int $page = 1, ?int $per_page = 10): array
    {
        try {
            $documentTypeModels =  GlobalStatusModel::orderBy("id")->paginate($per_page);
            $data = array_map(fn($item) => $this->mapToDomain($item), $documentTypeModels->items());

            $this->globalStatusArray = [
                "data" => $data,
                "pagination" => [
                    'current_page' => $documentTypeModels->currentPage(),
                    'last_page' => $documentTypeModels->lastPage(),
                    'per_page' => $documentTypeModels->perPage(),
                    'total' => $documentTypeModels->total(),
                ]
            ];
            return $this->globalStatusArray;
        } catch (Exception $e) {

            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getOneById(GlobalStatusId $id): ?GlobalStatus
    {
        try{

            $globalStatusDb = GlobalStatusModel::where("id", $id->value())->first();

            if(!$globalStatusDb){
                throw new InfrastructureException("identificador de Global Status no encontrado", Response::HTTP_NOT_FOUND);
            }

            $document = $this->mapToDomain($globalStatusDb);

            return $document;

        }catch(Exception $e){
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function delete(GlobalStatusId $id): void
    {
        try {
            $documentTypeDb = GlobalStatusModel::find($id->value());

            $documentTypeDb->current = false;
            $documentTypeDb->save();
            $documentTypeDb->delete();

        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function mapToDomain(GlobalStatusModel $document): GlobalStatus
    {
        return new GlobalStatus(
            name: new GlobalStatusName($document->name),
            description: new GlobalStatusDescription($document->description),
            table_header: new GlobalStatusTableHeader($document->active),
            id: new GlobalStatusId($document->id),
        );
    }
}
