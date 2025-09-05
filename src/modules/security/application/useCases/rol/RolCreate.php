<?php
namespace Src\modules\security\application\useCases\rol;

use Src\modules\security\application\dtos\RolDto;
use Src\modules\security\domain\entities\rol\Rol;
use Src\modules\security\domain\repositories\rol\RolRepositoryInterface;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsId;
use Src\modules\security\domain\value_objects\rol_value_object\RolDescription;
use Src\modules\security\domain\value_objects\rol_value_object\RolIdStatus;
use Src\modules\security\domain\value_objects\rol_value_object\RolName;

class RolCreate {
    private readonly RolRepositoryInterface $rolRepository;

    public function __construct(RolRepositoryInterface $rol_repository)
    {
        $this->rolRepository = $rol_repository;
    }

    public function run (RolDto $rolDto) : void {

        $permissionsId = array_map(fn($id_permission) => new PermissionsId($id_permission), $rolDto->permissions_ids ?? []);
        
        $rol = new Rol(
            new RolName($rolDto->name),
            new RolDescription($rolDto->description),
            new RolIdStatus($rolDto->id_status),
            null,
            $permissionsId
        );

        $this->rolRepository->create($rol);
    }
}