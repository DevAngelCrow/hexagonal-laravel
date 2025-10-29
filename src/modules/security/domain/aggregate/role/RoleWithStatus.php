<?php
namespace Src\modules\security\domain\aggregate\role;

use Src\modules\catalogs\domain\entities\GlobalStatus;
use Src\modules\security\domain\entities\rol\Rol;

class RoleWithStatus {
    private Rol $rol;
    private GlobalStatus $global_status;
    

    public function __construct(Rol $rol, GlobalStatus $global_status){
        $this->rol = $rol;
        $this->global_status = $global_status;
    }

    public function getRol() : Rol {
        return $this->rol;
    }
    public function getGlobalStatus() : GlobalStatus {
        return $this->global_status;
    }
}