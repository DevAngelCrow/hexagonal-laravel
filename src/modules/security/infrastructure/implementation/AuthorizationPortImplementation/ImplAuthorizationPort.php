<?php

namespace Src\modules\security\infrastructure\implementation\AuthorizationPortImplementation;

use App\Models\MntRoute;
use Exception;
use Illuminate\Support\Facades\Auth;
use Src\modules\security\domain\entities\menu\Menu;
use Src\modules\security\domain\ports\SecurityAuthorizationPortInterface;
use Src\modules\security\domain\value_objects\menu_value_object\MenuActive;
use Src\modules\security\domain\value_objects\menu_value_object\MenuChildren;
use Src\modules\security\domain\value_objects\menu_value_object\MenuDescription;
use Src\modules\security\domain\value_objects\menu_value_object\MenuIcon;
use Src\modules\security\domain\value_objects\menu_value_object\MenuId;
use Src\modules\security\domain\value_objects\menu_value_object\MenuName;
use Src\modules\security\domain\value_objects\menu_value_object\MenuOrder;
use Src\modules\security\domain\value_objects\menu_value_object\MenuParent;
use Src\modules\security\domain\value_objects\menu_value_object\MenuPermissions;
use Src\modules\security\domain\value_objects\menu_value_object\MenuRequiredAuth;
use Src\modules\security\domain\value_objects\menu_value_object\MenuShow;
use Src\modules\security\domain\value_objects\menu_value_object\MenuTitle;
use Src\modules\security\domain\value_objects\menu_value_object\MenuUri;
use Src\shared\infrastructure\exceptions\InfrastructureException;
use Src\shared\infrastructure\HttpResponses;
use Symfony\Component\HttpFoundation\Response;

class ImplAuthorizationPort implements SecurityAuthorizationPortInterface
{

    use HttpResponses;

    public function hasRole(array $role): bool
    {
        $user = Auth::user();

        if (!$user) {
            return false;
        }


        $roles = $user->id;

        return false;
    }
    public function checkPermission(string $permission): bool
    {
        try {
            $user = Auth::user();
            /**@var \App\Models\MntUser $user */
            $permmisionCollection = $user->permissions();

            if (!$user) {
                throw new InfrastructureException("No autorizado", Response::HTTP_UNAUTHORIZED);

                return false;
            }
            return $permmisionCollection->contains(fn($perm) => $perm->name === $permission);
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function filterRoutesForUser(): array
    {
        try {
            $user = Auth::user();

            if (!$user) {
                throw new InfrastructureException("No autorizado", Response::HTTP_UNAUTHORIZED);
            }

            /**@var \App\Models\MntUser $user */
            $permissionsIds = $user->permissions()->pluck('id')->all();

            $routes = MntRoute::whereHas('permissions', function ($q) use ($permissionsIds) {
                $q->whereIn('ctl_permissions.id', $permissionsIds);
            })
                ->with([
                    'children:id,name,description,icon,uri,active,id_parent,order,required_auth,show,title',
                    'parent:id,name,description,icon,uri,active,order,required_auth,show,title',
                    'permissions:id,name,description,id_category_permissions,active'
                ])
                ->get()
                ->unique('id')
                ->values();

            $routeMapped = array_map(fn($route) => new Menu(
                new MenuActive($route['active']),
                new MenuChildren($route['children']),
                new MenuDescription($route['description']),
                new MenuIcon($route['icon']),
                new MenuName($route['name']),
                new MenuOrder($route['order']),
                new MenuParent($route['parent']),
                new MenuRequiredAuth($route['required_auth']),
                new MenuShow($route['show']),
                new MenuTitle($route['title']),
                new MenuUri($route['uri']),
                new MenuPermissions($route['permissions']),
                new MenuId($route['id'])
            ), $routes->toArray());

            return $routeMapped;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
