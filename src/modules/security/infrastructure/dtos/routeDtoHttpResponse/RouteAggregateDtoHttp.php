<?php
namespace Src\modules\security\infrastructure\dtos\routeDtoHttpResponse;

use Src\modules\security\application\dtos\RouteDtoAggregate;
use Src\modules\security\domain\aggregate\routes\RouteWithChild;
use Src\modules\security\domain\entities\route\Route;

class RouteAggregateDtoHttp {
    public function __construct(public readonly RouteWithChild $route)
    {
        
    }
    public static function fromEntity(RouteWithChild $route) : self {
        $isRouteParent = $route->getParentRoute() ? $route->getParentRoute() : null;
        
        $dtoRouteWithChild = new self(
            new RouteWithChild(
                $route->getChildRoute(),
                $isRouteParent
            )
        );
        return $dtoRouteWithChild;
    }
}