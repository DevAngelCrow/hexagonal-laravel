<?php
namespace Src\modules\auth\infrastructure\controllers;

use App\Http\Controllers\Controller;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Src\modules\auth\application\useCases\dtos\UserDto;
use Src\shared\infrastructure\HttpResponses;
use Src\modules\auth\application\useCases\user\UserCreate;
use Src\modules\auth\infrastructure\validators\user\CreateUserRequest;

class UserController extends Controller
{
    use HttpResponses;

    protected UserCreate $userCreate;

    public function __construct(UserCreate $user_create) {
        $this->userCreate = $user_create;
    }

    public function createUser(CreateUserRequest $request){

        $user = new UserDto(
            $request->id_people,
            $request->user_name,
            $request->password,
            (int) $request->id_status,
            new \DateTimeImmutable ($request->last_access),
            $request->is_validated
        );

        $this->userCreate->run($user);

        return $this->created([], "Usuario creado satisfactoriamente");
    }
}
