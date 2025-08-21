<?php
namespace Src\modules\security\application\useCases\rol;

use Src\modules\security\application\dtos\RolDto;
use Src\modules\security\domain\entities\rol\Rol;
use Src\modules\security\domain\repositories\rol\RolRepositoryInterface;
use Src\modules\security\domain\value_objects\rol_value_object\RolDescription;
use Src\modules\security\domain\value_objects\rol_value_object\RolId;
use Src\modules\security\domain\value_objects\rol_value_object\RolIdStatus;
use Src\modules\security\domain\value_objects\rol_value_object\RolName;
use Src\shared\application\exceptions\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class RolUpdate {
    private readonly RolRepositoryInterface $rolRepository;

    public function __construct(RolRepositoryInterface $rol_repository)
    {
        $this->rolRepository = $rol_repository;
    }

    public function run (RolDto $rolDto) : void {
        $rolDb = $this->rolRepository->getOneById(new RolId($rolDto->id));

        if(!$rolDb){
            throw new ApplicationException("Identificador del rol no encontrado", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }

        $rolUpdate = new Rol(
            new RolName($rolDto->name),
            new RolDescription($rolDto->description),
            new RolIdStatus($rolDto->id_status),
            new RolId($rolDto->id)
        );

        $this->rolRepository->update($rolUpdate);
    }
}