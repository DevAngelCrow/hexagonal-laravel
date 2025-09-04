<?php
namespace Src\modules\security\application\dtos;
use Src\modules\security\domain\entities\route\Route;

class RouteDto {
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly string $icon,
        public readonly string $uri,
        public readonly bool $active,
        public readonly bool $show,
        public readonly int $order,
        public readonly ?int $id_parent = null,
        public readonly ?array $permissions_ids = null,
        public readonly ?int $id = null,
    )
    {

    }

    public static function fromEntity(Route $route) : self {
        return new self(
            $route->getName()->value(),
            $route->getDescription()->value(),
            $route->getIcon()->value(),
            $route->getUri()->value(),
            $route->getActive()->value(),
            $route->getShow()->value(),
            $route->getOrder()->value(),
            $route->getIdParent()->value() ?: null,
            $route->getPermissionsId() ?: null,
            $route->getId()->value() ?: null,
        );

    }
}