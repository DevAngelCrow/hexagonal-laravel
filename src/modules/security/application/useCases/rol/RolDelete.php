<?php
namespace Src\modules\security\application\useCases\rol;

use Src\modules\security\domain\repositories\rol\RolRepositoryInterface;
use Src\modules\security\domain\value_objects\rol_value_object\RolId;
use Src\shared\application\exceptions\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class RolDelete {
    private readonly RolRepositoryInterface $rolRepository;

    public function __construct(RolRepositoryInterface $rol_repository)
    {
        $this->rolRepository = $rol_repository;
    }

    public function run(int $id) : void {
        $rolDb = $this->rolRepository->getOneById(new RolId($id));

        if(!$rolDb){
            throw new ApplicationException("Identificador del rol no encontrado", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }

        $this->rolRepository->delete($rolDb->getId());
    } 
}