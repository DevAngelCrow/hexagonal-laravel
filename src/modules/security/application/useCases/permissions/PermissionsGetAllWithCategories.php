<?php
namespace Src\modules\security\application\useCases\permissions;

use Src\modules\security\domain\repositories\permissions\PermissionsRepositoryInterface;

class PermissionsGetAllWithCategories {
    private readonly PermissionsRepositoryInterface $permissionsRepository;

    public function __construct(PermissionsRepositoryInterface $permissions_repository)
    {
        $this->permissionsRepository = $permissions_repository;
    }

    public function run (?int $page, ?int $per_page, ?string $filter_name = null) : array {
        return $this->permissionsRepository->getAllWithCategories($page, $per_page, $filter_name);
    }
}