<?php
namespace Src\modules\security\application\useCases\category_permissions;

use Src\modules\security\domain\repositories\category_permissions\CategoryPermissionsRepositoryInterface;
use Src\modules\security\domain\value_objects\category_permissions_value_object\CategoryPermissionsId;
use Src\shared\application\exceptions\ApplicationException;

class CategoryPermissionsDelete {
    private readonly CategoryPermissionsRepositoryInterface $categoryPermissionsRepository;

    public function __construct(CategoryPermissionsRepositoryInterface $category_permissions_repository)
    {
        $this->categoryPermissionsRepository = $category_permissions_repository;
    }

    public function run(int $id) : void {
        
        $categoryPermissionsDb = $this->categoryPermissionsRepository->getOneById(new CategoryPermissionsId($id));

        if(!$categoryPermissionsDb){
            throw new ApplicationException("Identificador de la categoría del permiso no encontrado");
        }

        $this->categoryPermissionsRepository->delete($categoryPermissionsDb->getId());
    }
}