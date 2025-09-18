<?php
namespace Src\modules\security\domain\repositories\route;

use Src\modules\security\domain\entities\route\Route;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesId;

interface RouteRepositoryInterface {
    public function create(Route $route) : ?Route;
    public function update(Route $route) : void;
    /**
     * @return Route[];
     */
    public function getAll(int $page, int $per_page) : array;
    public function getOneById(RoutesId $id): ?Route;
    public function delete(RoutesId $id) : void;

    /**
     * @return RouteWithChild[];
     */
    public function getAllRoutesWithParentData(int $page, int $per_page) : array;
}