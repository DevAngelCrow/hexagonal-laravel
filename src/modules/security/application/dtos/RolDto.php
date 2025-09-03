<?php
namespace Src\modules\security\application\dtos;

use Src\modules\security\domain\entities\rol\Rol;

class RolDto {
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly int $id_status,
        public readonly ?array $permissions_ids = null,
        public readonly ?int $id = null
    ){ }

    public static function fromEntity(Rol $rol) : self{
        $prueba = new self(
            $rol->getName()->value(),
            $rol->getDescription()->value(),
            $rol->getIdStatus()->value(),
            $rol->getPermissions(),
            $rol->getId()->value() ?: null
        );

        return $prueba;
    }
}