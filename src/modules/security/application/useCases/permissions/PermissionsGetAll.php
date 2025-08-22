<?php
namespace Src\modules\security\application\useCases\permissions;

use Src\modules\security\domain\repositories\permissions\PermissionsRepositoryInterface;

class PermissionsGetAll {
    private readonly PermissionsRepositoryInterface $permissionsRepository;

    public function __construct(PermissionsRepositoryInterface $permissions_repository)
    {
        $this->permissionsRepository = $permissions_repository;
    }

    public function run (?int $page, ?int $per_page) : array {
        return $this->permissionsRepository->getAll($page, $per_page);
    }
}