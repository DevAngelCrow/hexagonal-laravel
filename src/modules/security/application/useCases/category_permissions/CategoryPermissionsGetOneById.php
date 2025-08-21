<?php
namespace Src\modules\security\application\useCases\category_permissions;

use Src\modules\security\domain\entities\category_permissions\CategoryPermissions;
use Src\modules\security\domain\repositories\category_permissions\CategoryPermissionsRepositoryInterface;
use Src\modules\security\domain\value_objects\category_permissions_value_object\CategoryPermissionsId;

class CategoryPermissionsGetOneById {
    private readonly CategoryPermissionsRepositoryInterface $categoryPermissionsRepository;

    public function __construct(CategoryPermissionsRepositoryInterface $category_permissions_repository)
    {
        $this->categoryPermissionsRepository = $category_permissions_repository;
    }

    public function run(int $id) : CategoryPermissions {
       return $this->categoryPermissionsRepository->getOneById(new CategoryPermissionsId($id));
    }
}