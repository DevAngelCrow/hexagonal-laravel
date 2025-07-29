<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Src\modules\auth\infrastructure\controllers\AuthController;
use Illuminate\Support\Facades\Mail;
use App\Models\MntUser;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix("address")->group(base_path("Src/modules/profile/infrastructure/routes/AddressRoutes.php"));
Route::prefix("person")->group(base_path("Src/modules/profile/infrastructure/routes/PeopleRoutes.php"));
Route::prefix("user")->group(base_path("Src/modules/auth/infrastructure/routes/UserRoutes.php"));
Route::prefix("auth")->group(base_path("Src/modules/auth/infrastructure/routes/AuthRoutes.php"));


// Enviar correo de verificación nuevamente
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return response()->json(['message' => 'Correo enviado']);
})->middleware(['auth:api', 'throttle:6,1']);

// Verificar email
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); // marca como verificado

    return response()->json(['message' => 'Correo verificado']);
})->middleware(['auth:api', 'signed']);


Route::get('/test-mail', function () {
    $user = MntUser::with('people')->first();

    Mail::raw('Test correo', function ($message) use ($user) {
        $message->to($user->getEmailForVerification())
                ->subject('Correo de prueba');
    });

    return 'Correo de prueba enviado (o en proceso)';
});