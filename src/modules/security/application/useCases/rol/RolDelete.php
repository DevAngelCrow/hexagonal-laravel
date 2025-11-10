<?php
namespace Src\modules\security\application\useCases\rol;

use Src\modules\catalogs\application\services\globalStatus\GlobalStatusGetOneByNameService;
use Src\modules\security\domain\repositories\rol\RolRepositoryInterface;
use Src\modules\security\domain\value_objects\rol_value_object\RolId;
use Src\shared\application\exceptions\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class RolDelete {
    private readonly RolRepositoryInterface $rolRepository;
    private readonly GlobalStatusGetOneByNameService $globalStatusGetOneByNameService;

    public function __construct(RolRepositoryInterface $rol_repository, GlobalStatusGetOneByNameService $globalStatusGetOneByNameService)
    {
        $this->rolRepository = $rol_repository;
        $this->globalStatusGetOneByNameService = $globalStatusGetOneByNameService;
    }
    

    public function run(int $id) : void {
        $rolDb = $this->rolRepository->getOneByIdEntity(new RolId($id));

        if(!$rolDb){
            throw new ApplicationException("Identificador del rol no encontrado", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }
        $statusInactive = $this->globalStatusGetOneByNameService->globalStatusGetOneByNameService('Inactivo', 'mnt_role');
        $statusActive = $this->globalStatusGetOneByNameService->globalStatusGetOneByNameService('Activo', 'mnt_role');
        
        if($rolDb->getIdStatus()->value() === $statusInactive->getId()->value()){
            $this->rolRepository->delete($rolDb->getId(), $statusActive->getId()->value());
            return;
        }
        $this->rolRepository->delete($rolDb->getId(), $statusInactive->getId()->value());
        
    } 
}