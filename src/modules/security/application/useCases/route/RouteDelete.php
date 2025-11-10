<?php
namespace Src\modules\security\application\useCases\route;

use Src\modules\security\domain\repositories\route\RouteRepositoryInterface;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesId;
use Src\shared\application\exceptions\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class RouteDelete {
    private readonly RouteRepositoryInterface $routeRepository;

    public function __construct(RouteRepositoryInterface $route_repository)
    {
        $this->routeRepository = $route_repository;
    }

    public function run(int $id) : void {

        $routeDb = $this->routeRepository->getOneRouteEntityById(new RoutesId($id));
        if(!$routeDb){
            throw new ApplicationException("Identificador de ruta no encontrado", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }
        $this->routeRepository->delete($routeDb->getId());
    }
}