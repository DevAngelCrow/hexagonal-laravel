<?php

namespace Src\modules\security\domain\entities\rol;

use Src\modules\security\domain\exceptions\PermissionsException;
use Src\modules\security\domain\value_objects\rol_value_object\RolDescription;
use Src\modules\security\domain\value_objects\rol_value_object\RolId;
use Src\modules\security\domain\value_objects\rol_value_object\RolIdStatus;
use Src\modules\security\domain\value_objects\rol_value_object\RolName;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsId;

class Rol
{
    private readonly RolName $name;
    private readonly RolDescription $description;
    private readonly RolIdStatus $id_status;
    private readonly ?RolId $id;
    /** @var PermissionsId[] */
    private readonly ?array $permissionsId;

    public function __construct(RolName $name, RolDescription $description, RolIdStatus $id_status, ?RolId $id = null, ?array $permissionsId = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->id_status = $id_status;
        $this->permissionsId = $permissionsId;
        $this->id = $id;
            if(!empty($permissionsId)){
            foreach($this->permissionsId as $permissionId){
            if(!$permissionId instanceof PermissionsId){
                throw new PermissionsException("La instancia de cada elemento debe ser de tipo PermissionsId");
            }
          }
        }
    }

    public function getName(): RolName
    {
        return $this->name;
    }

    public function getDescription(): RolDescription
    {
        return $this->description;
    }

    public function getIdStatus(): RolIdStatus
    {
        return $this->id_status;
    }

    public function getId(): ?RolId
    {
        return $this->id;
    }

    public function getPermissions(): ?array
    {
        return $this->permissionsId;
    }
}
