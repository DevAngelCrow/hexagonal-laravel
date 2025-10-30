<?php
namespace Src\modules\security\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\modules\security\application\useCases\security_authorization_port\FilterRoutesForUser;
use Src\modules\security\domain\entities\menu\Menu;
use Src\modules\security\infrastructure\dtos\secutiryAuthorizationPortHttpResponse\MenuDtoHttp;
use Src\shared\infrastructure\HttpResponses;

class MenuController extends Controller {
    use HttpResponses;

    protected readonly FilterRoutesForUser $filterRoutesForUser;

    public function __construct(FilterRoutesForUser $filter_routes_for_user)
    {
        $this->filterRoutesForUser = $filter_routes_for_user;
    }

    public function getMenuUser(Request $request) {

        $menuRaw = $this->filterRoutesForUser->run();
        //dd($menuRaw);
        $menu = array_map(fn($route) => 
            
            MenuDtoHttp::fromEntity($route), $menuRaw);
        //dd($menu);
       return $this->success($menu, 'Success');
    }
}