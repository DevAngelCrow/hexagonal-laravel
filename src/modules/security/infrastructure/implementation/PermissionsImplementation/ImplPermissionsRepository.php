<?php

namespace Src\modules\security\infrastructure\implementation\PermissionsImplementation;

use App\Models\CtlPermissions as PermissionsModel;
use Exception;
use LogicException;
use Src\modules\security\domain\entities\permissions\Permissions;
use Src\modules\security\domain\repositories\permissions\PermissionsRepositoryInterface;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsActive;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsDescription;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsId;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsIdCategoryPermissions;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsName;
use Src\shared\infrastructure\exceptions\InfrastructureException;
use Symfony\Component\HttpFoundation\Response;

class ImplPermissionsRepository implements PermissionsRepositoryInterface
{
    private $permissionsArray = [];
    public function create(Permissions $permissions): void
    {
        try {
            $permissionsModel = new PermissionsModel();

            $permissionsModel->name = $permissions->getName()->value();
            $permissionsModel->id_category_permissions = $permissions->getIdCategoryPermissions()->value();
            $permissionsModel->description = $permissions->getDescription()->value();

            $permissionsModel->save();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update(Permissions $permissions): void
    {
        try {
            $permissionsModel = PermissionsModel::find($permissions->getId()->value());

            $permissionsModel->name = $permissions->getName()->value();
            $permissionsModel->id_category_permissions = $permissions->getIdCategoryPermissions()->value();
            $permissionsModel->description = $permissions->getDescription()->value();

            $permissionsModel->save();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getAll(?int $page, ?int $per_page): array
    {
        try {

            $query = PermissionsModel::select('id', 'name', 'description', 'active', 'id_category_permissions')->orderBy('id');

            if ($page !== null && $per_page !== null) {
                $permissionsModels = PermissionsModel::orderBy("id")->paginate($per_page);
                $data = array_map(fn($item) => $this->mapToDomain($item), $permissionsModels->items());

                $this->permissionsArray = [
                    "data" => $data,
                    "pagination" => [
                        "currentPage" => $permissionsModels->currentPage(),
                        "lastPage" => $permissionsModels->lastPage(),
                        "perPage" => $permissionsModels->perPage(),
                        "totalItems" => $permissionsModels->total()
                    ]
                ];

                return $this->permissionsArray;
            }

            $permissionsModels = $query->get();

            $this->permissionsArray = array_map(fn($item) => $this->mapToDomain($item), $permissionsModels->all());
            return $this->permissionsArray;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getOneById(PermissionsId $id): ?Permissions
    {
        try {
            $permissionsModel = PermissionsModel::find($id->value());

            if (!$permissionsModel) {
                throw new InfrastructureException("Identificador de permiso no encontrado", Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $permissions = $this->mapToDomain($permissionsModel);

            return $permissions;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function delete(PermissionsId $id): void
    {
        try {
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        throw new LogicException("Método no implementado");
    }
    private function mapToDomain(PermissionsModel $permissions): Permissions
    {
        $permissionsMapped = new Permissions(
            new PermissionsName($permissions->name),
            new PermissionsIdCategoryPermissions($permissions->id_category_permissions),
            new PermissionsDescription($permissions->description),
            new PermissionsActive($permissions->active),
            new PermissionsId($permissions->id)
        );

        return $permissionsMapped;
    }
}
