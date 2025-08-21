<?php
namespace Src\modules\security\application\useCases\route;

use Src\modules\security\application\dtos\RouteDto;
use Src\modules\security\domain\entities\route\Route;
use Src\modules\security\domain\repositories\route\RouteRepositoryInterface;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesActive;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesDescription;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesIcon;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesId;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesIdParent;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesName;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesOrder;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesShow;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesUri;
use Src\shared\application\exceptions\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class RouteUpdate {
    private readonly RouteRepositoryInterface $routeRepository;

    public function __construct(RouteRepositoryInterface $route_repository)
    {
        $this->routeRepository = $route_repository;
    }

    public function run (RouteDto $routeDto) : void {
        $routeDb = $this->routeRepository->getOneById(new RoutesId($routeDto->id));

        if(!$routeDb){
            throw new ApplicationException("Identificador de ruta no encontrado", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }

        $routeUpdate = new Route(
            new RoutesIdParent($routeDto->id_parent),
            new RoutesName($routeDto->name),
            new RoutesDescription($routeDto->description),
            new RoutesIcon($routeDto->icon),
            new RoutesUri($routeDto->uri),
            new RoutesActive($routeDto->active),
            new RoutesShow($routeDto->show),
            new RoutesOrder($routeDto->order),
            new RoutesId($routeDto->id)
        );

        $this->routeRepository->update($routeUpdate);
    }
}