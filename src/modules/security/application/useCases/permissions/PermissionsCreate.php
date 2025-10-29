<?php
namespace Src\modules\security\application\useCases\permissions;

use Src\modules\security\application\dtos\PermissionsDto;
use Src\modules\security\domain\entities\permissions\Permissions;
use Src\modules\security\domain\repositories\permissions\PermissionsRepositoryInterface;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsActive;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsDescription;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsIdCategoryPermissions;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsName;

class PermissionsCreate {
    private readonly PermissionsRepositoryInterface $permissionsRepository;
    public function __construct(PermissionsRepositoryInterface $permissions_repository)
    {
        $this->permissionsRepository = $permissions_repository;
    }

    public function run(PermissionsDto $permisssionsDto) : void {
        $permission = new Permissions(
            new PermissionsName($permisssionsDto->name),
            new PermissionsIdCategoryPermissions($permisssionsDto->id_category_permissions),
            new PermissionsDescription($permisssionsDto->description),
            new PermissionsActive($permisssionsDto->active),
        );

        $this->permissionsRepository->create($permission);
    } 
}