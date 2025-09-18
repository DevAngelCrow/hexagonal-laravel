<?php
namespace Src\modules\catalogs\infrastructure\implementation\GlobalRepositoryImplementation;

use Src\modules\catalogs\domain\entities\GlobalStatus;
use Src\modules\catalogs\domain\repositories\GlobalStatusRepositoryInterface;
use App\Models\CtlGlobalStatus as GlobalStatusModel;
use ErrorException;
use Exception;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusActive;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusDescription;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusId;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusName;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusTableHeader;
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
            $globalStatusModel->state = $globalStatus->getActive()->value();
            $globalStatusModel->save();
        } catch (ErrorException $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update(GlobalStatus $globalStatus): void
    {
        try {

            $globalStatusModel = GlobalStatusModel::find($globalStatus->getId()->value());

            $globalStatusModel->name = $globalStatus->getName()->value();
            $globalStatusModel->description = $globalStatus->getDescription()->value();
            $globalStatusModel->table_header = $globalStatus->getTableHeader()->value();
            
            
            $globalStatusModel->save();
        } catch (ErrorException $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getAll(?int $page = 1, ?int $per_page = 10): array
    {
        try {
            $globalStatusModels =  GlobalStatusModel::orderBy("id")->paginate($per_page);
            $data = array_map(fn($item) => $this->mapToDomain($item), $globalStatusModels->items());

            $this->globalStatusArray = [
                "data" => $data,
                "pagination" => [
                    'current_page' => $globalStatusModels->currentPage(),
                    'last_page' => $globalStatusModels->lastPage(),
                    'per_page' => $globalStatusModels->perPage(),
                    'total' => $globalStatusModels->total(),
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

            $globalStatus = $this->mapToDomain($globalStatusDb);

            return $globalStatus;

        }catch(Exception $e){
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function delete(GlobalStatusId $id): void
    {
        try {
            $documentTypeDb = GlobalStatusModel::find($id->value());

            $documentTypeDb->state = false;
            $documentTypeDb->save();
            $documentTypeDb->delete();

        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function mapToDomain(GlobalStatusModel $globalStatus): GlobalStatus
    {
        return new GlobalStatus(
            name: new GlobalStatusName($globalStatus->name),
            description: new GlobalStatusDescription($globalStatus->description),
            table_header: new GlobalStatusTableHeader($globalStatus->table_header),
            active: new GlobalStatusActive($globalStatus->state),
            id: new GlobalStatusId($globalStatus->id),
        );
    }
}
