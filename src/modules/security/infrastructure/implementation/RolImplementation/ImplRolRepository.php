<?php

namespace Src\modules\security\infrastructure\implementation\RolImplementation;

use App\Models\MntRol as RolModel;
use Exception;
use LogicException;
use Src\modules\security\domain\entities\rol\Rol;
use Src\modules\security\domain\repositories\rol\RolRepositoryInterface;
use Src\modules\security\domain\value_objects\rol_value_object\RolDescription;
use Src\modules\security\domain\value_objects\rol_value_object\RolId;
use Src\modules\security\domain\value_objects\rol_value_object\RolIdStatus;
use Src\modules\security\domain\value_objects\rol_value_object\RolName;
use Src\shared\infrastructure\exceptions\InfrastructureException;
use Symfony\Component\HttpFoundation\Response;

class ImplRolRepository implements RolRepositoryInterface
{
    private $rolArray = [];
    public function create(Rol $rol): void
    {
        try {
            $rolModel = new RolModel();

            $rolModel->name = $rol->getName()->value();
            $rolModel->description = $rol->getDescription()->value();
            $rolModel->id_status = $rol->getIdStatus()->value();

            $rolModel->save();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }
    public function update(Rol $rol): void
    {
        try {
            $rolModel = RolModel::find($rol->getId()->value());

            $rolModel->name = $rol->getName()->value();
            $rolModel->description = $rol->getDescription()->value();
            $rolModel->id_status = $rol->getIdStatus()->value();

            $rolModel->save();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }
    public function getAll(int $page, int $per_page): array
    {
        try {
            $rolModels = RolModel::orderBy("id")->paginate($per_page);
            $data = array_map(fn($item) => $this->mapToDomain($item), $rolModels->items());

            $this->rolArray = [
                "data" => $data,
                "pagination" => [
                    "current_page" => $rolModels->currentPage(),
                    "last_page" => $rolModels->lastPage(),
                    "per_page" => $rolModels->perPage(),
                    "total" => $rolModels->total()
                ]
            ];

            return $this->rolArray;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }
    public function getOneById(RolId $id): ?Rol
    {
        try {

            $rolModel = RolModel::find($id->value());

            if (!$rolModel) {
                throw new InfrastructureException("Identificador de rol no encontrado", Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $rol = $this->mapToDomain($rolModel);

            return $rol;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }
    public function delete(RolId $id): void
    {
        try {
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        throw new LogicException("Método no implementado");
    }
    private function mapToDomain(RolModel $rol): Rol
    {
        $rolMapped = new Rol(
            new RolName($rol->name),
            new RolDescription($rol->description),
            new RolIdStatus($rol->id_status),
            new RolId($rol->id)
        );

        return $rolMapped;
    }
}
