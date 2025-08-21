<?php
namespace Src\modules\security\application\useCases\route;

use Src\modules\security\domain\repositories\route\RouteRepositoryInterface;

class RouteGetAll {
    private readonly RouteRepositoryInterface $routeRepository;

    public function __construct(RouteRepositoryInterface $route_repository)
    {
        $this->routeRepository = $route_repository;
    }

    public function run (?int $page, ?int $per_page) : array {
        return $this->routeRepository->getAll($page, $per_page);
    }
}