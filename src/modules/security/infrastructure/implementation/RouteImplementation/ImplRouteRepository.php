<?php

namespace Src\modules\security\infrastructure\implementation\RouteImplementation;

use App\Models\MntRoute as RouteModel;
use Exception;
use LogicException;
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
use Src\shared\infrastructure\exceptions\InfrastructureException;
use Symfony\Component\HttpFoundation\Response;

class ImplRouteRepository implements RouteRepositoryInterface
{
    private $routesArray = [];
    public function create(Route $route): void
    {
        try {
            $routeModel = new RouteModel();

            $routeModel->id_parent = $route->getIdParent()->value();
            $routeModel->name = $route->getName()->value();
            $routeModel->description = $route->getDescription()->value();
            $routeModel->icon = $route->getIcon()->value();
            $routeModel->uri = $route->getUri()->value();
            $routeModel->active = $route->getActive()->value();
            $routeModel->show = $route->getShow()->value();
            $routeModel->order = $route->getOrder()->value();

            $routeModel->save();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update(Route $route): void
    {
        try {
            $routeModel = RouteModel::find($route->getId()->value());

            $routeModel->id_parent = $route->getIdParent()->value();
            $routeModel->name = $route->getName()->value();
            $routeModel->description = $route->getDescription()->value();
            $routeModel->icon = $route->getIcon()->value();
            $routeModel->uri = $route->getUri()->value();
            $routeModel->active = $route->getActive()->value();
            $routeModel->show = $route->getShow()->value();
            $routeModel->order = $route->getOrder()->value();

            $routeModel->save();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getAll(int $page, int $per_page): array
    {
        try {
            $routeModels = RouteModel::orderBy("id")->paginate($per_page);
            $data = array_map(fn($item) => $this->mapToDomain($item), $routeModels->items());

            $this->routesArray = [
                "data" => $data,
                "pagination" => [
                    "current_page" => $routeModels->currentPage(),
                    "last_page" => $routeModels->lastPage(),
                    "per_page" => $routeModels->perPage(),
                    "total" => $routeModels->total()
                ]
            ];

            return $this->routesArray;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getOneById(RoutesId $id): ?Route
    {
        try {
            $routeModel = RouteModel::find($id->value());

            if (!$routeModel) {
                throw new InfrastructureException("Identificador de rol no encontrado", Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $route = $this->mapToDomain($routeModel);

            return $route;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function delete(RoutesId $id): void
    {
        try {
            $routeModel = RouteModel::find($id->value());

            $routeModel->active = false;
            $routeModel->save();
            $routeModel->delete();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    private function mapToDomain(RouteModel $route): Route
    {
        $routeMapped = new Route(
            new RoutesIdParent($route->id_parent),
            new RoutesName($route->name),
            new RoutesDescription($route->description),
            new RoutesIcon($route->icon),
            new RoutesUri($route->uri),
            new RoutesActive($route->active),
            new RoutesShow($route->show),
            new RoutesOrder($route->order)
        );

        return $routeMapped;
    }
}
