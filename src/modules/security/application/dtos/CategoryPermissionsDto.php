<?php
namespace Src\modules\security\application\dtos;

use Src\modules\security\domain\entities\category_permissions\CategoryPermissions;

class CategoryPermissionsDto {
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly ?int $id = null
    )
    {}
     public static function fromEntity(CategoryPermissions $categoryPermissions) : self {
            return new self(
                $categoryPermissions->getName()->value(),
                $categoryPermissions->getDescription()->value(),
                $categoryPermissions->getId()->value() ?: null
            );
        }
}