<?php
namespace Src\modules\security\application\useCases\rol;

use Src\modules\security\domain\aggregate\role\RoleWithStatus;
use Src\modules\security\domain\entities\rol\Rol;
use Src\modules\security\domain\repositories\rol\RolRepositoryInterface;
use Src\modules\security\domain\value_objects\rol_value_object\RolId;

class RolGetOneById {
    private readonly RolRepositoryInterface $rolRepository;

    public function __construct(RolRepositoryInterface $rol_repository)
    {
        $this->rolRepository = $rol_repository;
    }

    public function run (int $id) : RoleWithStatus {
        return $this->rolRepository->getOneById(new RolId($id));
    }
}