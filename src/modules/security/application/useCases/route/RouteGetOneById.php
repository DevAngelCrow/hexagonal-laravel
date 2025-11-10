<?php
namespace Src\modules\security\application\useCases\route;

use Src\modules\security\domain\aggregate\routes\RouteWithChild;
use Src\modules\security\domain\entities\route\Route;
use Src\modules\security\domain\repositories\route\RouteRepositoryInterface;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesId;

class RouteGetOneById {
    private readonly RouteRepositoryInterface $routeRepository;

    public function __construct(RouteRepositoryInterface $route_repository)
    {
        $this->routeRepository = $route_repository;
    }

    public function run(int $id) : RouteWithChild {
        return $this->routeRepository->getOneById(new RoutesId($id));
    }
}