<?php
namespace Src\modules\security\application\useCases\permissions;

use Src\modules\security\application\dtos\PermissionsDto;
use Src\modules\security\domain\entities\permissions\Permissions;
use Src\modules\security\domain\repositories\permissions\PermissionsRepositoryInterface;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsDescription;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsId;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsIdCategoryPermissions;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsName;
use Src\shared\application\exceptions\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class PermissionsUpdate{
    private readonly PermissionsRepositoryInterface $permissionsRepository;

    public function __construct(PermissionsRepositoryInterface $permissions_repository)
    {
        $this->permissionsRepository = $permissions_repository;
    }

    public function run(PermissionsDto $permissionsDto) : void {
        $permissionsDb = $this->permissionsRepository->getOneById(new PermissionsId($permissionsDto->id));

        if(!$permissionsDb){
            throw new ApplicationException("Identificador de permiso no encontrado", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }

        $permissionsUpdate = new Permissions(
            new PermissionsName($permissionsDto->name),
            new PermissionsIdCategoryPermissions($permissionsDto->id_category_permissions),
            new PermissionsDescription($permissionsDto->description),
            new PermissionsId($permissionsDto->id)
        );

        $this->permissionsRepository->update($permissionsUpdate);
    }
}