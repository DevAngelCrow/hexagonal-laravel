<?php
namespace Src\modules\security\infrastructure\dtos\routeDtoHttpResponse;

use Src\modules\security\domain\entities\route\Route;

class RouteDtoHttp {
    public function __construct(
        
        public readonly string $name,
        public readonly string $description,
        public readonly string $icon,
        public readonly string $uri,
        public readonly bool $active,
        public readonly bool $show,
        public readonly int $order,
        public readonly ?int $id_parent = null,
        public readonly ?int $id = null,
        public readonly mixed $parent = null
    )
    {
        
    }

    public static function fromEntity(Route $route) : self {

        $parentDto = $route->getParent() ? self::fromEntity($route->getParent()) : null;

        return new self(
            $route->getName()->value(),
            $route->getDescription()->value(),
            $route->getIcon()->value(),
            $route->getUri()->value(),
            $route->getActive()->value(),
            $route->getShow()->value(),
            $route->getOrder()->value(),
            $route->getIdParent()->value() ?: null,
            $route->getId()->value() ?: null,
            $parentDto
        );
    }
}