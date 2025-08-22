<?php
namespace Src\modules\security\application\useCases\permissions;

use Src\modules\security\domain\repositories\permissions\PermissionsRepositoryInterface;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsId;
use Src\shared\application\exceptions\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class PermissionsDelete{
    private readonly PermissionsRepositoryInterface $permissionsRepository;

    public function __construct(PermissionsRepositoryInterface $permissions_repository)
    {
        $this->permissionsRepository = $permissions_repository;
    }

    public function run($id) : void {
        $permissionsDb = $this->permissionsRepository->getOneById(new PermissionsId($id));

        if(!$permissionsDb){
            throw new ApplicationException("Identificador de permiso no encontrado", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }

        $this->permissionsRepository->delete($permissionsDb->getId());
    }
}