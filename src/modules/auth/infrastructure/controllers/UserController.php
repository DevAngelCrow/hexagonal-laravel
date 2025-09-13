<?php
namespace Src\modules\auth\infrastructure\controllers;

use App\Http\Controllers\Controller;
use DateTimeImmutable;
use Src\modules\auth\application\useCases\dtos\UserDto;
use Src\shared\infrastructure\HttpResponses;
use Src\modules\auth\application\useCases\user\UserCreate;
use Src\modules\auth\application\useCases\user\UserGetOneByUserName;
use Src\modules\auth\infrastructure\dtos\userDtoHttpResponse\UserDtoHttpResponse;
use Src\modules\auth\infrastructure\validators\user\CreateUserRequest;
use Src\modules\auth\infrastructure\validators\user\GetOneByUserNameRequest;


class UserController extends Controller
{
    use HttpResponses;

    protected UserCreate $userCreate;
    protected UserGetOneByUserName $userGetOneByUserName;

    public function __construct(UserCreate $user_create, UserGetOneByUserName $user_get_one_by_user_name) {
        $this->userCreate = $user_create;
        $this->userGetOneByUserName = $user_get_one_by_user_name;
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

    public function getOneByUserName(GetOneByUserNameRequest $request) {
        $user = $this->userGetOneByUserName->run($request->user_name);

        return $this->success(UserDtoHttpResponse::fromEntity($user), "Success");
    }
}
