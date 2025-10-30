<?php
namespace Src\modules\security\application\dtos;

use Src\modules\security\domain\entities\permissions\Permissions;

class PermissionsDto {
    public function __construct(
        public readonly string $name,
        public readonly int $id_category_permissions,
        public readonly string $description,
        public readonly ?bool $active = null,
        public readonly ?int $id = null
    )
    {}
    public static function fromEntity(Permissions $permissions) : self {
        return new self(
            $permissions->getName()->value(),
            $permissions->getIdCategoryPermissions()->value(),
            $permissions->getDescription()->value(),
            $permissions->getActive()->value() ?: null,
            $permissions->getId()->value() ?: null
        );
    }
}