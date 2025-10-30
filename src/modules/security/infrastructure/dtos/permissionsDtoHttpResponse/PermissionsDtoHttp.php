<?php
namespace Src\modules\security\infrastructure\dtos\permissionsDtoHttpResponse;

use Src\modules\security\domain\entities\permissions\Permissions;

class PermissionsDtoHttp {
    public function __construct(
        public readonly string $name,
        public readonly int $id_category_permissions,
        public readonly string $description,
        public readonly bool $active,
        public readonly ?int $id = null,
    )
    {}
    public static function fromEntity(Permissions $permissions) : self {
        return new self(
            $permissions->getName()->value(),
            $permissions->getIdCategoryPermissions()->value(),
            $permissions->getDescription()->value(),
            $permissions->getActive()->value(),
            $permissions->getId()->value() ?: null
        );
    }
}