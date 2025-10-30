<?php
namespace Src\modules\security\application\useCases\category_permissions;

use Src\modules\security\application\dtos\CategoryPermissionsDto;
use Src\modules\security\domain\entities\category_permissions\CategoryPermissions;
use Src\modules\security\domain\repositories\category_permissions\CategoryPermissionsRepositoryInterface;
use Src\modules\security\domain\value_objects\category_permissions_value_object\CategoryPermissionsActive;
use Src\modules\security\domain\value_objects\category_permissions_value_object\CategoryPermissionsDescription;
use Src\modules\security\domain\value_objects\category_permissions_value_object\CategoryPermissionsId;
use Src\modules\security\domain\value_objects\category_permissions_value_object\CategoryPermissionsName;
use Src\shared\application\exceptions\ApplicationException;

class CategoryPermissionsUpdate {
    private readonly CategoryPermissionsRepositoryInterface $categoryPermissionsRepository;

    public function __construct(CategoryPermissionsRepositoryInterface $category_permissions_repository)
    {   
        $this->categoryPermissionsRepository = $category_permissions_repository;
    }

    public function run(CategoryPermissionsDto $categoryPermissionDto) : void{
        $categoryPermissionsDb = $this->categoryPermissionsRepository->getOneById(new CategoryPermissionsId($categoryPermissionDto->id));

        if(!$categoryPermissionsDb){
            throw new ApplicationException("Identificador de la categoría del permiso no encontrado");
        }

        $categoryPermissionsUpdate = new CategoryPermissions(
            new CategoryPermissionsName($categoryPermissionDto->name),
            new CategoryPermissionsDescription($categoryPermissionDto->description),
            new CategoryPermissionsActive($categoryPermissionDto->active),
            new CategoryPermissionsId($categoryPermissionDto->id),
        );

        $this->categoryPermissionsRepository->update($categoryPermissionsUpdate);
    }
}