<?php

namespace Src\modules\security\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\modules\security\application\dtos\RouteDto;
use Src\modules\security\application\useCases\route\RouteCreate;
use Src\modules\security\application\useCases\route\RouteDelete;
use Src\modules\security\application\useCases\route\RouteGetAll;
use Src\modules\security\application\useCases\route\RouteGetAllRoutesWithParent;
use Src\modules\security\application\useCases\route\RouteGetOneById;
use Src\modules\security\application\useCases\route\RouteUpdate;
use Src\modules\security\infrastructure\dtos\routeDtoHttpResponse\RouteAggregateDtoHttp;
use Src\modules\security\infrastructure\dtos\routeDtoHttpResponse\RouteDtoHttp;
use Src\modules\security\infrastructure\validators\route\CreateRouteRequest;
use Src\modules\security\infrastructure\validators\route\GetAllRouteRequest;
use Src\modules\security\infrastructure\validators\route\GetByIdRouteRequest;
use Src\modules\security\infrastructure\validators\route\UpdateRouteRequest;
use Src\shared\infrastructure\generalDtos\PaginatedResponseDto;
use Src\shared\infrastructure\HttpResponses;

class RouteController extends Controller
{
    use HttpResponses;

    protected RouteCreate $routeCreate;
    protected RouteUpdate $routeUpdate;
    protected RouteGetAll $routeGetAll;
    protected RouteGetOneById $routeGetOneById;
    protected RouteGetAllRoutesWithParent $routeGetAllRoutesWithParent;
    protected RouteDelete $routeDelete;

    public function __construct(
        RouteCreate $route_create,
        RouteUpdate $route_update,
        RouteGetAll $route_get_all,
        RouteGetOneById $route_get_one_by_id,
        RouteGetAllRoutesWithParent $route_get_all_routes_with_parent,
        RouteDelete $route_delete
    ) {
        $this->routeCreate = $route_create;
        $this->routeUpdate = $route_update;
        $this->routeGetAll = $route_get_all;
        $this->routeGetOneById = $route_get_one_by_id;
        $this->routeGetAllRoutesWithParent = $route_get_all_routes_with_parent;
        $this->routeDelete = $route_delete;
    }

    public function createRoute(CreateRouteRequest $request)
    {

        $createRoute = new RouteDto(
            $request->name,
            $request->description,
            $request->icon,
            $request->uri,
            $request->active ?? true,
            $request->show,
            $request->order,
            $request->id_parent,
            $request->permissions_id,
            null,
            $request->title
        );
        $this->routeCreate->run($createRoute);

        return $this->created([], "Ruta creada satisfactoriamente");
    }
    public function updateRoute(UpdateRouteRequest $request)
    {

        $updateRoute = new RouteDto(
            $request->name,
            $request->description,
            $request->icon,
            $request->uri,
            $request->active,
            $request->show,
            $request->order,
            $request->id_parent,
            $request->permissions_id,
            $request->id,
            $request->title
        );
        $this->routeUpdate->run($updateRoute);

        return $this->success([], "Registro de ruta actualizado satisfactoriamente");
    }

    public function getOneByIdRoute(GetByIdRouteRequest $request)
    {
        $route = $this->routeGetOneById->run($request->id);
        return $this->success(RouteAggregateDtoHttp::fromEntity($route)->toArray());
    }
    public function getAllRoutes(GetAllRouteRequest $request)
    {
        $routesCollection = $this->routeGetAll->run($request->query("page"), $request->query("per_page"));
        if ($request->query("page") && $request->query("per_page")) {
            $collections = array_map(fn($item) => RouteDtoHttp::fromEntity($item), $routesCollection["data"]);
            $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $routesCollection["pagination"]);
            return $this->success($paginateData, "Success");
        }
        $data = array_map(fn($item) => RouteDtoHttp::fromEntity($item), $routesCollection);
        return $this->success($data, "Success");
    }
    public function getAllRoutesWithParent(GetAllRouteRequest $request)
    {
        $routesCollection = $this->routeGetAllRoutesWithParent->run($request->query("page"), $request->query("per_page"), $request->query("filter_name"));
        if ($request->query("page") && $request->query("per_page")) {
            $collections = array_map(fn($item) => RouteAggregateDtoHttp::fromEntity($item)->toArray(), $routesCollection["data"]);

            $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $routesCollection["pagination"]);

            return $this->success($paginateData, "Success");
        }
        $data = array_map(fn($item)=> RouteAggregateDtoHttp::fromEntity($item)->toArray(), $routesCollection);
        return $this->success($data, "Success");
    }
    public function deleteRoute(GetByIdRouteRequest $request){
        $this->routeDelete->run($request->id);
        return $this->success([], 'Ruta eliminada correctamente');
    }
}
