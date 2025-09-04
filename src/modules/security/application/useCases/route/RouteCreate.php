<?php
namespace Src\modules\security\application\useCases\route;

use Src\modules\security\application\dtos\RouteDto;
use Src\modules\security\domain\entities\route\Route;
use Src\modules\security\domain\repositories\route\RouteRepositoryInterface;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsId;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesActive;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesDescription;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesIcon;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesIdParent;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesName;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesOrder;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesShow;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesUri;

class RouteCreate {
    private readonly RouteRepositoryInterface $routeRepository;

    public function __construct(RouteRepositoryInterface $route_repository)
    {
        $this->routeRepository = $route_repository;
    }

    public function run(RouteDto $routeDto) : void {


        $permissionsId = array_map(fn($id_permission) => new PermissionsId($id_permission), $routeDto->permissions_ids ?? []);
        $route = new Route(
            new RoutesName($routeDto->name),
            new RoutesDescription($routeDto->description),
            new RoutesIcon($routeDto->icon),
            new RoutesUri($routeDto->uri),
            new RoutesActive($routeDto->active),
            new RoutesShow($routeDto->show),
            new RoutesOrder($routeDto->order),
            new RoutesIdParent($routeDto->id_parent),
            $permissionsId,
            null
        );



        $this->routeRepository->create($route);
    }
}