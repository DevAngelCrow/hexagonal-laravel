<?php
namespace Src\modules\security\application\useCases\category_permissions;

use Src\modules\security\domain\repositories\category_permissions\CategoryPermissionsRepositoryInterface;

class CategoryPermissionsGetAll {
    private readonly CategoryPermissionsRepositoryInterface $categoryPermissionsRepository;

    public function __construct(CategoryPermissionsRepositoryInterface $category_permissions_repository)
    {
        $this->categoryPermissionsRepository = $category_permissions_repository;
    }

    public function run(?int $page, ?int $per_page) : array {
        return $this->categoryPermissionsRepository->getAll($page, $per_page);
    }
}