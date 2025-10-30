<?php
namespace Src\modules\auth\infrastructure\implementation\AuthPortImplementation;

use App\Models\MntUser as UserModel;
use Exception;
use Illuminate\Support\Facades\Auth;
use Src\modules\auth\domain\ports\CloseSessionPortInterface;
use Src\modules\auth\domain\value_objects\user_value_objects\UserName;
use Src\shared\infrastructure\exceptions\InfrastructureException;

class ImplCloseSessionPortInterface implements CloseSessionPortInterface {
    public function logout(UserName $user_name): bool
    {
        try{
            $user = Auth::user();
            if(!$user){
                return false;
            }

            
            $currentToken = $user->token();
            
            if($currentToken){
                $currentToken->revoke();
                return true;
            }
            return false;
        }catch(Exception $e){
            throw new InfrastructureException($e, "Error al cerrar sesion");
        }
    }
}