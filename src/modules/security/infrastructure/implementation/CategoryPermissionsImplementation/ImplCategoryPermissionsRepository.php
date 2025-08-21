<?php

namespace Src\modules\security\infrastructure\implementation\CategoryPermissionsImplementation;

use App\Models\CtlCategoryPermissions as CategoryPermissionsModel;
use Exception;
use LogicException;
use Src\modules\security\domain\entities\category_permissions\CategoryPermissions;
use Src\modules\security\domain\repositories\category_permissions\CategoryPermissionsRepositoryInterface;
use Src\modules\security\domain\value_objects\category_permissions_value_object\CategoryPermissionsDescription;
use Src\modules\security\domain\value_objects\category_permissions_value_object\CategoryPermissionsId;
use Src\modules\security\domain\value_objects\category_permissions_value_object\CategoryPermissionsName;
use Src\shared\infrastructure\exceptions\InfrastructureException;
use Symfony\Component\HttpFoundation\Response;

class ImplCategoryPermissionsRepository implements CategoryPermissionsRepositoryInterface
{
    private $categoryPermisionsArray = [];
    public function create(CategoryPermissions $category_permissions): void
    {
        try {
            $categoryPermissionModel = new CategoryPermissionsModel();

            $categoryPermissionModel->name = $category_permissions->getName()->value();
            $categoryPermissionModel->description = $category_permissions->getDescription()->value();

            $categoryPermissionModel->save();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(CategoryPermissions $category_permissions): void
    {
        try {
            $categoryPermissionModel = CategoryPermissionsModel::find($category_permissions->getId()->value());

            $categoryPermissionModel->name = $category_permissions->getName()->value();
            $categoryPermissionModel->description = $category_permissions->getDescription()->value();

            $categoryPermissionModel->save();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getAll(int $page, int $per_page): array
    {
        try {
            $categoryPermissionsModels = CategoryPermissionsModel::orderBy("id")->paginate($per_page);
            $data = array_map(fn($item) => $this->mapToDomain($item), $categoryPermissionsModels->items());

            $this->categoryPermisionsArray = [
                "data" => $data,
                "pagination" => [
                    "current_page" => $categoryPermissionsModels->currentPage(),
                    "last_page" => $categoryPermissionsModels->lastPage(),
                    "per_page" => $categoryPermissionsModels->perPage(),
                    "total" => $categoryPermissionsModels->total()
                ]
            ];

            return $this->categoryPermisionsArray;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getOneById(CategoryPermissionsId $id): ?CategoryPermissions
    {
        try {
            $categoryPermissionsModel = CategoryPermissionsModel::find($id->value());

            if (!$categoryPermissionsModel) {
                throw new InfrastructureException("Identificador de categoría de permiso no encontrado", Response::HTTP_NOT_FOUND);
            }

            $categoryPermissions = $this->mapToDomain($categoryPermissionsModel);

            return $categoryPermissions;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete(CategoryPermissionsId $id): void
    {
        try {
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        throw new LogicException("Método no implementado");
    }
    private function mapToDomain(CategoryPermissionsModel $categoryPermission): CategoryPermissions
    {
        $categoryPermissionMapped = new CategoryPermissions(
            new CategoryPermissionsName($categoryPermission->name),
            new CategoryPermissionsDescription($categoryPermission->description),
            new CategoryPermissionsId($categoryPermission->id)
        );

        return $categoryPermissionMapped;
    }
}
