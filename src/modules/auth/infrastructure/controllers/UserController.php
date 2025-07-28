<?php
namespace Src\modules\auth\infrastructure\controllers;

use App\Http\Controllers\Controller;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Src\shared\infrastructure\HttpResponses;
use Src\modules\auth\application\useCases\user\UserCreate;


class UserController extends Controller
{
    use HttpResponses;

    protected UserCreate $userCreate;

    public function __construct(UserCreate $user_create) {
        $this->userCreate = $user_create;
    }

    public function createUser(Request $request){

        $id_people = $request->id_people;
        $user_name = $request->user_name;
        $password = $request->password;
        $id_status = $request->id_status;
        $last_access = new \DateTimeImmutable ($request->last_access);
        $is_validated = $request->is_validated;

        $this->userCreate->run($id_people, $user_name, $password, $id_status, $last_access, $is_validated);

        return $this->created([], "Usuario creado satisfactoriamente");
    }
}
