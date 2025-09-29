<?php

namespace Src\modules\auth\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\MntUser;
use DateTimeImmutable;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Src\shared\infrastructure\HttpResponses;
use Src\modules\auth\application\useCases\auth\Register;
use Src\modules\auth\application\useCases\auth\Login;
use Src\modules\auth\application\useCases\auth\Logout;
use Src\modules\auth\application\useCases\dtos\RegisterDto;
use Src\modules\auth\infrastructure\validators\auth\LoginRequest;
use Src\modules\auth\infrastructure\validators\auth\RegisterRequest;

class AuthController extends Controller
{
    use HttpResponses;

    protected Register $registerUser;
    protected Login $loginUser;
    protected Logout $logoutUser;

    public function __construct(Register $register_user, Login $login_user, Logout $logout_user)
    {
        $this->registerUser = $register_user;
        $this->loginUser = $login_user;
        $this->logoutUser = $logout_user;
    }


    public function signUp(RegisterRequest $request)
    {
        $registerDto = new RegisterDto(
            
            //person data input
            $request->first_name,
            $request->middle_name,
            $request->last_name,
            new \DateTimeImmutable($request->birthdate),
            $request->email,
            (int) $request->id_gender,
            (int) $request->id_marital_status,
            $request->phone,
            /*(int) $request->id_status ??*/ 1,
            $request->nationalities,
            $request->fileImg,
            null,
            //user data input
            $request->user_name,
            $request->password,
            /*(int) $request->id_status_user ??*/ 2,
            new \DateTimeImmutable($request->last_access),
            $request->is_validated,
            null,
            //address data input
            $request->street,
            $request->street_number,
            $request->neighborhood,
            (int) $request->id_district,
            $request->house_number,
            $request->block,
            $request->pathway,
            $request->current,
            null,
            true,
            //document data input
            (int) $request->id_type_document,
            $request->document_number,
            $request->description,
            $request->active
        );

        $provider = config('storage.provider_code');
        $user = $this->registerUser->run(
            $registerDto, $provider
        );


        return $this->created([], "Registro de usuario exitoso");
    }

    public function login(LoginRequest $request)
    {

        $data = $this->loginUser->run(
            $request->user_name,
            $request->password
        );

        return $this->success([
            'access_token' => $data['access_token'],
            'token_type' => 'Bearer',
            'user' => $data['user']
        ], "Success");
    }

    public function logout(Request $request){
        $session = $this->logoutUser->run($request->user_name);
        
        if(!$session){
            return $this->internalServerError("Error interno al cerrar sesion");
        }
        return $this->success([], 'Session finalizada correctamente');
    }

    public function verifyEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->success([], "Usuario ya verificado");
        }

        $request->user()->sendEmailVerificationNotification();

        return $this->success([], "Correo de verificación enviado");
    }

    public function receptionToValidate(Request $request, $id, $hash)
    {
        $user = MntUser::findOrFail($id);

        if(!hash_equals(sha1($user->getEmailForVerification()), $hash)){
            return $this->forbiden("Link invalido o expirado");
        }

        if($user->hasVerifiedEmail()){
            return $this->success([], "Correo ya verificado");
        }

        $user->markEmailAsVerified();
        event(new Verified($user));

        return $this->success([], "Correo verificado exitosamente");
    }
}
