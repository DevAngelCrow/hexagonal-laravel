<?php
namespace Src\modules\security\application\useCases\route;

use Src\modules\security\domain\repositories\route\RouteRepositoryInterface;

class RouteGetAllRoutesWithParent {
    private readonly RouteRepositoryInterface $routeRepository;

    public function __construct(RouteRepositoryInterface $route_repository)
    {
        $this->routeRepository = $route_repository;
    }

    public function run (?int $page = null, ?int $per_page = null, ?string $filter_name = null) : array {
        return $this->routeRepository->getAllRoutesWithParentData($page, $per_page, $filter_name);
    }
}