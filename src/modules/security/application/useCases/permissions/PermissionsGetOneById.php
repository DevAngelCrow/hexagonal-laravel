<?php
namespace Src\modules\security\application\useCases\permissions;

use Src\modules\security\domain\entities\permissions\Permissions;
use Src\modules\security\domain\repositories\permissions\PermissionsRepositoryInterface;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsId;

class PermissionsGetOneById {
    private readonly PermissionsRepositoryInterface $permissionsRepository;

    public function __construct(PermissionsRepositoryInterface $permissions_repository)
    {
        $this->permissionsRepository = $permissions_repository;
    }

    public function run(int $id) : Permissions {
        return $this->permissionsRepository->getOneById(new PermissionsId($id));
    }
}