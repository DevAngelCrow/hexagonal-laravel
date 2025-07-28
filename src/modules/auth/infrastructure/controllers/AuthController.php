<?php

namespace Src\modules\auth\infrastructure\controllers;

use App\Http\Controllers\Controller;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Src\shared\infrastructure\HttpResponses;
use Src\modules\auth\application\useCases\auth\Register;

class AuthController extends Controller
{
    use HttpResponses;

    protected Register $registerUser;

    public function __construct(Register $register_user)
    {
        $this->registerUser = $register_user;
    }


    public function singUp(Request $request)
    {
        $first_name = $request->first_name;
        $birthdate = new \DateTimeImmutable($request->birthdate);
        $id_gender = $request->id_gender;
        $email = $request->email;
        $id_marital_status = $request->id_marital_status;
        $phone = $request->phone;
        $id_status = $request->id_status;
        $middle_name = $request->middle_name;
        $last_name = $request->last_name;
        $img_path = $request->img_path;

        $user_name = $request->user_name;
        $password = $request->password;
        $id_status_user = $request->id_status_user;
        $last_access = new \DateTimeImmutable($request->last_access);
        $is_validated = $request->is_validated;

        //dd($is_validated);
        $this->registerUser->run(
            $first_name,
            $middle_name,
            $last_name,
            $birthdate,
            $id_gender,
            $email,
            $id_marital_status,
            $img_path,
            $phone,
            $id_status,
            $user_name,
            $password,
            $id_status_user,
            $last_access,
            $is_validated
        );

        return $this->created([], "Registro de usuario exitoso");
    }
}
