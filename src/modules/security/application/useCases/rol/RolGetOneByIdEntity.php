<?php
namespace Src\modules\security\application\useCases\rol;

use Src\modules\security\domain\entities\rol\Rol;
use Src\modules\security\domain\repositories\rol\RolRepositoryInterface;
use Src\modules\security\domain\value_objects\rol_value_object\RolId;

class RolGetOneByIdEntity{
    private readonly RolRepositoryInterface $rolRepository;
    public function __construct(RolRepositoryInterface $rolRepository)
    {
        $this->rolRepository = $rolRepository;
    }
    public function run(int $id) : Rol{
        return $this->rolRepository->getOneByIdEntity(new RolId($id));
    }
}