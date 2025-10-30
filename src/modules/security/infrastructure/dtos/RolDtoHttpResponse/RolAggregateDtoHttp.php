<?php
namespace Src\modules\security\infrastructure\dtos\RolDtoHttpResponse;

use Src\modules\security\domain\aggregate\role\RoleWithStatus;

class RolAggregateDtoHttp {
    public function __construct(public readonly RoleWithStatus $roleWithStatus)
    {
        
    }
    public static function fromAggregate(RoleWithStatus $roleWithStatus) : self{
        return new self($roleWithStatus);
    }
    public function toArray() : array {
        $role = $this->roleWithStatus->getRol();
        $globalStatus = $this->roleWithStatus->getGlobalStatus();
        $roleMappedData = [
            "id" => $role->getId()->value(),
            "name" => $role->getName()->value(),
            "description" => $role->getDescription()->value(),
            "id_status" => $role->getIdStatus()->value()
        ];
        $globalStatusMappedData = [
            "id" => $globalStatus->getId()->value(),
            "name" => $globalStatus->getName()->value(),
            "description" => $globalStatus->getDescription()->value()
        ];

        $roleMappedData["status"] = $globalStatusMappedData;
        
        return $roleMappedData;
    }
}