<?php

namespace Src\modules\auth\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Models\MntUser;
use DateTimeImmutable;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\shared\infrastructure\HttpResponses;
use Src\modules\auth\application\useCases\auth\Register;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Src\modules\auth\application\useCases\dtos\RegisterDto;
use Src\modules\auth\infrastructure\validators\auth\RegisterRequest;

class AuthController extends Controller
{
    use HttpResponses;

    protected Register $registerUser;

    public function __construct(Register $register_user)
    {
        $this->registerUser = $register_user;
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

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user_name' => 'required|string',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return $this->unauthorized("No autorizado");
            //return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = MntUser::where('user_name', $request->user_name)->first();

        if(!$user->hasVerifiedEmail()){
            return $this->forbiden("Por favor verifica tu correo antes de iniciar sesión");
        }

        $token = $user->createToken('authToken')->accessToken;

        return $this->success([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ], "Success");
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

        //$request->fulfill();

        $user->markEmailAsVerified();
        event(new Verified($user));

        return $this->success([], "Correo verificado exitosamente");
    }
}
