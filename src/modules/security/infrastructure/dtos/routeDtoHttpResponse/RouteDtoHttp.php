<?php
namespace Src\modules\security\infrastructure\dtos\routeDtoHttpResponse;

use Src\modules\security\domain\entities\route\Route;

class RouteDtoHttp {
    public function __construct(
        public readonly int $id_parent,
        public readonly string $name,
        public readonly string $description,
        public readonly string $icon,
        public readonly string $uri,
        public readonly bool $active,
        public readonly bool $show,
        public readonly int $order,
        public readonly ?int $id = null
    )
    {
        
    }

    public static function fromEntity(Route $route) : self {
        return new self(
            $route->getIdParent()->value(),
            $route->getName()->value(),
            $route->getDescription()->value(),
            $route->getIcon()->value(),
            $route->getUri()->value(),
            $route->getActive()->value(),
            $route->getShow()->value(),
            $route->getOrder()->value(),
            $route->getId()->value() ?: null
        );
    }
}