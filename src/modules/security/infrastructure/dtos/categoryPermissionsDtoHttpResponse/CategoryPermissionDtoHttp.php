<?php
namespace Src\modules\security\infrastructure\dtos\categoryPermissionsDtoHttpResponse;

use Src\modules\security\domain\entities\category_permissions\CategoryPermissions;

class CategoryPermissionDtoHttp {
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly bool $active,
        public readonly ?int $id = null
    )
    {}
     public static function fromEntity(CategoryPermissions $categoryPermissions) : self {
            return new self(
                $categoryPermissions->getName()->value(),
                $categoryPermissions->getDescription()->value(),
                $categoryPermissions->getActive()->value(),
                $categoryPermissions->getId()->value() ?: null
            );
        }
}