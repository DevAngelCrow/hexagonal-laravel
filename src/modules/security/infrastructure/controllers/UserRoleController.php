<?php

namespace Src\modules\security\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\modules\security\application\dtos\UserRoleDto;
use Src\modules\security\application\useCases\user_role\UserRoleCreate;
use Src\modules\security\application\useCases\user_role\UserRoleUpdate;
use Src\modules\security\infrastructure\validators\userRol\CreateUserRolRequest;
use Src\modules\security\infrastructure\validators\userRol\UpdateUserRolRequest;
use Src\shared\infrastructure\HttpResponses;

class UserRoleController extends Controller {
    
    use HttpResponses;
    protected UserRoleCreate $userRoleCreate;
    protected UserRoleUpdate $userRoleUpdate;

    public function __construct(UserRoleCreate $userRoleCreate, UserRoleUpdate $userRoleUpdate)
    {
        $this->userRoleCreate = $userRoleCreate;
        $this->userRoleUpdate = $userRoleUpdate;
    }

    public function createUserRol(CreateUserRolRequest $request) {
       
        $userRoleCreate = new UserRoleDto(
            $request->id_user,
            $request->role_ids
        );

        $this->userRoleCreate->run($userRoleCreate);

        return $this->created([], "Asignacion de rol a usuario exitosa");

    }

    public function updateUserRol(UpdateUserRolRequest $request) {
        
        $userRoleUpdate = new UserRoleDto(
            (int) $request->id_user,
            $request->role_ids,
            $request->id
        );

        $this->userRoleUpdate->run($userRoleUpdate);

        return $this->success([], "Actualización de rol a usuario exitosa");
    }
}