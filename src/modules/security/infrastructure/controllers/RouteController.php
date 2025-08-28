<?php

namespace Src\modules\security\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\modules\security\application\dtos\RouteDto;
use Src\modules\security\application\useCases\route\RouteCreate;
use Src\modules\security\application\useCases\route\RouteGetAll;
use Src\modules\security\application\useCases\route\RouteGetOneById;
use Src\modules\security\application\useCases\route\RouteUpdate;
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

    public function __construct(
        RouteCreate $route_create,
        RouteUpdate $route_update,
        RouteGetAll $route_get_all,
        RouteGetOneById $route_get_one_by_id
    ) {
        $this->routeCreate = $route_create;
        $this->routeUpdate = $route_update;
        $this->routeGetAll = $route_get_all;
        $this->routeGetOneById = $route_get_one_by_id;
    }

    public function createRoute(CreateRouteRequest $request)
    {
        $createRoute = new RouteDto(
            $request->id_parent,
            $request->name,
            $request->description,
            $request->icon,
            $request->uri,
            $request->active,
            $request->show,
            $request->order
        );

        $this->routeCreate->run($createRoute);

        return $this->created([], "Ruta creada satisfactoriamente");
    }
    public function updateRoute(UpdateRouteRequest $request)
    {
        $updateRoute = new RouteDto(
            $request->id_parent,
            $request->name,
            $request->description,
            $request->icon,
            $request->uri,
            $request->active,
            $request->show,
            $request->order,
            $request->id
        );
        $this->routeUpdate->run($updateRoute);

        return $this->success([], "Registro de ruta actualizado satisfactoriamente");
    }

    public function getOneByIdRoute(GetByIdRouteRequest $request)
    {
        $route = $this->routeGetOneById->run($request->id);
        return $this->success(["data" => RouteDtoHttp::fromEntity($route), "Success"]);
    }
    public function getAllRoutes(GetAllRouteRequest $request)
    {
        $routesCollection = $this->routeGetAll->run($request->query("page"), $request->query("per_page"));
        $collections = array_map(fn($item) => RouteDtoHttp::fromEntity($item), $routesCollection);
        $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $routesCollection["pagination"]);
        return $this->success($paginateData, "Success");
    }
}
