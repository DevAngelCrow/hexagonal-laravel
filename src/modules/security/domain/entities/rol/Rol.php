<?php

namespace Src\modules\security\domain\entities\rol;

use Src\modules\security\domain\value_objects\rol_value_object\RolDescription;
use Src\modules\security\domain\value_objects\rol_value_object\RolId;
use Src\modules\security\domain\value_objects\rol_value_object\RolIdStatus;
use Src\modules\security\domain\value_objects\rol_value_object\RolName;

class Rol
{
    private readonly RolName $name;
    private readonly RolDescription $description;
    private readonly RolIdStatus $id_status;
    private readonly ?RolId $id;

    public function __construct(RolName $name, RolDescription $description, RolIdStatus $id_status, ?RolId $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->id_status = $id_status;
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
}
