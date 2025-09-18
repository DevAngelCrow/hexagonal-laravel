<?php

// namespace Src\modules\security\application\dtos;

// use Src\modules\security\domain\aggregate\routes\RouteWithChild;
// use Src\modules\security\domain\entities\route\Route;

// class RouteDtoAggregate
// {
//     public function __construct(
//         public readonly RouteDtoAggregate $route,
//     ) {}

//     public static function fromEntity(Route $route): self
//     {
//         $route_relation = $route->getIdParent()->value();
//         $route_child;
//         if($route_relation){
//             $route_child = new Route(

//             );
//         }
//         return new self(
//             new RouteWithChild(
//                 $route_parent,
//                 $route_child
//             )
//         );
//     }
// }
