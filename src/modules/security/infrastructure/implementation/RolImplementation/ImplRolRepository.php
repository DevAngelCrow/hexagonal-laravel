<?php

namespace Src\modules\security\infrastructure\implementation\RolImplementation;

use App\Models\MntRol as RolModel;
use Exception;
use LogicException;
use Src\modules\catalogs\domain\entities\GlobalStatus;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusActive;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusDescription;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusId;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusName;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusTableHeader;
use Src\modules\security\domain\aggregate\role\RoleWithStatus;
use Src\modules\security\domain\entities\permissions\Permissions;
use Src\modules\security\domain\entities\rol\Rol;
use Src\modules\security\domain\repositories\rol\RolRepositoryInterface;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsActive;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsDescription;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsId;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsIdCategoryPermissions;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsName;
use Src\modules\security\domain\value_objects\rol_value_object\RolDescription;
use Src\modules\security\domain\value_objects\rol_value_object\RolId;
use Src\modules\security\domain\value_objects\rol_value_object\RolIdStatus;
use Src\modules\security\domain\value_objects\rol_value_object\RolName;
use Src\shared\infrastructure\exceptions\InfrastructureException;
use Symfony\Component\HttpFoundation\Response;

class ImplRolRepository implements RolRepositoryInterface
{
    private $rolArray = [];
    public function create(Rol $rol): ?Rol
    {
        try {

            $rolModel = new RolModel();

            $rolModel->name = $rol->getName()->value();
            $rolModel->description = $rol->getDescription()->value();
            $rolModel->id_status = $rol->getIdStatus()->value();

            $rolModel->save();


            $permissionIds = array_map(fn($id_permission) => $id_permission->value(), $rol->getPermissions());

            $rolModel->permissions()->syncWithoutDetaching($permissionIds);

            $mapeoDominio = $this->mapToDomain($rolModel);

            return $mapeoDominio;
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


            $newPermissions = array_map(fn($id_permission) => $id_permission->value(), $rol->getPermissions() ?? []);;


            $rolModel->permissions()->sync($newPermissions);
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getAll(?int $page, ?int $per_page, ?string $filter_name = null): array
    {
        try {

            $query = RolModel::select('id', 'name', 'description', 'id_status')->orderBy('id');
            if ($filter_name) {
                $query->where('name', 'ILIKE', "%{$filter_name}%");
            }
            if ($page !== null && $per_page !== null) {
                $rolModels = $query->paginate($per_page);
                $data = array_map(fn($item) => $this->mapToDomain($item), $rolModels->items());
                $this->rolArray = [
                    "data" => $data,
                    "pagination" => [
                        "currentPage" => $rolModels->currentPage(),
                        "lastPage" => $rolModels->lastPage(),
                        "perPage" => $rolModels->perPage(),
                        "totalItems" => $rolModels->total()
                    ]
                ];

                return $this->rolArray;
            }
            $rolModels = $query->get();
            $this->rolArray = array_map(fn($item) => $this->mapToDomain($item), $rolModels->all());
            return $this->rolArray;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getOneById(RolId $id): ?RoleWithStatus
    {
        try {

            $rolModel = RolModel::with('permissions:id,name,description,id_category_permissions,active')->select('id', 'name', 'description', 'id_status')->where('id', $id->value())->first();

            if (!$rolModel) {
                throw new InfrastructureException("Identificador de rol no encontrado", Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $rol = $this->mapToAggregateDomain($rolModel);
            
            return $rol;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function delete(RolId $id, int $id_status): void
    {
        try {
            $rolModel = RolModel::find($id->value());
            if (!$rolModel) {
                throw new InfrastructureException("Identificador de rol no encontrado", Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            $rolModel->id_status = $id_status;
            $rolModel->save();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getAllWithStatus(?int $page, ?int $per_page, ?string $filter_name = null): array
    {
        try {
            $query = RolModel::with('permissions:id,name,description,id_category_permissions,active')->select('id', 'name', 'description', 'id_status')->orderBy('id');
            if ($filter_name) {
                $query->where('name', 'ILIKE', "%{$filter_name}%");
            }
            if ($page !== null && $per_page !== null) {
                $rolModels = $query->paginate($per_page);
                $data = array_map(fn($item) => $this->mapToAggregateDomain($item), $rolModels->items());
                $this->rolArray = [
                    "data" => $data,
                    "pagination" => [
                        "currentPage" => $rolModels->currentPage(),
                        "lastPage" => $rolModels->lastPage(),
                        "perPage" => $rolModels->perPage(),
                        "totalItems" => $rolModels->total()
                    ]
                ];

                return $this->rolArray;
            }
            $rolModels = $query->get();
            $this->rolArray = array_map(fn($item) => $this->mapToAggregateDomain($item), $rolModels->all());
            return $this->rolArray;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getOneByIdEntity(RolId $id): ?Rol
    {
        try{
            $rolModel = RolModel::find($id->value());
            
            if (!$rolModel) {
                throw new InfrastructureException("Identificador de rol no encontrado", Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $rol = $this->mapToDomain($rolModel);
            
            return $rol;
        }catch(Exception $e){
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function mapToDomain(RolModel $rol): Rol
    {

        $permisssionIds = null;

        if (!empty($rol->permissions->toArray())) {
            $permisssionIds = collect($rol->permissions)->map(
                fn($permission) => new PermissionsId($permission->id)
            )->toArray();
        }

        $rolMapped = new Rol(
            new RolName($rol->name),
            new RolDescription($rol->description),
            new RolIdStatus($rol->id_status),
            new RolId($rol->id),
            $permisssionIds,

        );

        return $rolMapped;
    }
    private function mapToAggregateDomain(RolModel $role): RoleWithStatus
    {
        $permissions = null;
        if (!empty($role->permissions)) {
            $permissions = collect($role->permissions->toArray())->map(
                function ($permission) {
                    return new Permissions(
                        new PermissionsName($permission['name']),
                        new PermissionsIdCategoryPermissions($permission['id_category_permissions']),
                        new PermissionsDescription($permission['description']),
                        new PermissionsActive($permission['active']),
                        new PermissionsId($permission['id'])
                    );
                }
            )->toArray();
        }
        $globalStatus = $this->mapToDomainStatus($role);
        $roleMapped = new RoleWithStatus(
            new Rol(
                new RolName($role->name),
                new RolDescription($role->description),
                new RolIdStatus($role->id_status),
                new RolId($role->id),
            ),
            $globalStatus,
            $permissions
        );
        return $roleMapped;
    }
    private function mapToDomainStatus(RolModel $role): GlobalStatus
    {
        $globalStatus = $role->status;
        $globalStatusMapped = new GlobalStatus(
            new GlobalStatusName($globalStatus->name),
            new GlobalStatusDescription($globalStatus->description),
            new GlobalStatusTableHeader($globalStatus->table_header),
            new GlobalStatusActive($globalStatus->active),
            new GlobalStatusId($globalStatus->id)
        );
        return $globalStatusMapped;
    }
    private function mapToDomainPermissions(RolModel $role): Permissions
    {
        return new Permissions(
            new PermissionsName($role->permissions['name']),
            new PermissionsIdCategoryPermissions($role->permission['id_category_permissions']),
            new PermissionsDescription($role->permission['description']),
            new PermissionsActive($role->permission['active']),
            new PermissionsId($role->permission['id'])
        );
    }
}
