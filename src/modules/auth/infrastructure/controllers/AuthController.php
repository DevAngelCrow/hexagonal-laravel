<?php

namespace Src\modules\auth\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\MntUser;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\shared\infrastructure\HttpResponses;
use Src\modules\auth\application\useCases\auth\Register;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


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
        //people data input
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

        //user data input
        $user_name = $request->user_name;
        $password = $request->password;
        $id_status_user = $request->id_status_user;
        $last_access = new \DateTimeImmutable($request->last_access);
        $is_validated = $request->is_validated;

        //address data input
        $street = $request->street;
        $street_number = $request->street_number;
        $neighborhood = $request->neighborhood;
        $id_district = $request->id_district;
        $house_number = $request->house_number;
        $block = $request->block;
        $pathway = $request->pathway;
        $current = $request->current;

        $user =$this->registerUser->run(
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
            $is_validated,
            $street,
            $street_number,
            $neighborhood,
            $id_district,
            $house_number,
            $block,
            $pathway,
            $current
        );

              
        return $this->created([], "Registro de usuario exitoso");
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user_name' => 'required|string',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = MntUser::where('user_name', $request->user_name)->first();
        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }
    
    public function verifyEmail(Request $request){
        if($request->user()->hasVerifiedEmail()){
            return $this->success([], "Usuario ya verificado");
        }

        $request->user()->sendEmailVerificationNotification();

        return $this->success([], "Correo de verificación enviado");
    }

    public function receptionToValidate(EmailVerificationRequest $request){
        $request->fulfill();

        return $this->success([], "Correo verificado exitosamente");
    }
}
