<?php
namespace Src\modules\security\application\useCases\category_permissions;

use Src\modules\security\application\dtos\CategoryPermissionsDto;
use Src\modules\security\domain\entities\category_permissions\CategoryPermissions;
use Src\modules\security\domain\repositories\category_permissions\CategoryPermissionsRepositoryInterface;
use Src\modules\security\domain\value_objects\category_permissions_value_object\CategoryPermissionsDescription;
use Src\modules\security\domain\value_objects\category_permissions_value_object\CategoryPermissionsName;

class CategoryPermissionsCreate {
    private readonly CategoryPermissionsRepositoryInterface $categoryRepository;

    public function __construct(CategoryPermissionsRepositoryInterface $category_repository)
    {
        $this->categoryRepository = $category_repository;
    }

    public function run(CategoryPermissionsDto $categoryPermissionsDto) : void {
        $categoryPermission = new CategoryPermissions(
            new CategoryPermissionsName($categoryPermissionsDto->name),
            new CategoryPermissionsDescription($categoryPermissionsDto->description),
        );

        $this->categoryRepository->create($categoryPermission);
        
    } 
}