<?php
namespace Src\modules\security\infrastructure\dtos\secutiryAuthorizationPortHttpResponse;

use Src\modules\security\domain\entities\menu\Menu;

class MenuDtoHttp {
    public function __construct(
        public readonly bool $active,
        public readonly array $children,
        public readonly mixed $parent,
        public readonly array $permissions,
        public readonly string $description,
        public readonly string $icon,
        public readonly string $name,
        public readonly int $order,
        public readonly bool $required_auth,
        public readonly bool $show,
        public readonly string $title,
        public readonly string $uri,
        public readonly ?int $id = null,
    )
    {}

    public static function fromEntity(Menu $menu) : self {
        return new self(
            $menu->getActive()->value(),
            $menu->getChildren()->value(),
            $menu->getParent()->value(),
            $menu->getPermissions()->value(),
            $menu->getDescription()->value(),
            $menu->getIcon()->value(),
            $menu->getName()->value(),
            $menu->getOrder()->value(),  
            $menu->getRequiredAuth()->value(),
            $menu->getShow()->value(),
            $menu->getTitle()->value(),
            $menu->getUri()->value(),
            $menu->getId()->value()
        );
    }
}