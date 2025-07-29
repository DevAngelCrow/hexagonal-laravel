<?php

namespace Src\modules\auth\infrastructure\implementation\UserRepositoryImplementation;

use Exception;
use LogicException;
use Src\modules\auth\domain\entities\user\User;
use Src\modules\auth\domain\repositories\user\UserRepositoryInterface;
use Src\modules\auth\domain\value_objects\user_value_objects\UserId;
use App\Models\MntUser as UserModel;
use Illuminate\Support\Facades\Hash;
use Src\shared\infrastructure\exceptions\InfrastructureException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Src\modules\auth\application\useCases\auth\Register;

class ImplUserRepository implements UserRepositoryInterface
{
    public function create(User $user): void
    {
        try {

            $userModel = new UserModel;

            $userModel->id_people = $user->getIdPeople()->value();
            $userModel->user_name = $user->getUserName()->value();
            $userModel->password = Hash::make($user->getPassword()->value());
            $userModel->id_status = $user->getIdStatus()->value();
            $userModel->last_access = $user->getLastAccess()->value();
            $userModel->is_validated = false /*$user->getIsValidated()->value()*/;

            $userModel->save();
            $userModel->load('people');
            event(new Registered($userModel));
            //Log::info($userModel);
        } catch (Exception $e) {
            throw new InfrastructureException($e);
        }
    }
    public function update(User $user): void
    {
        throw new LogicException("El método aun no ha sido implementado");
    }
    public function getAll(): array
    {
        throw new LogicException("El método aun no ha sido implementado");
    }

    public function getOneById(UserId $id): ?User
    {
        throw new LogicException("El método aun no ha sido implementado");
    }

    public function delete(UserId $id): void
    {
        throw new LogicException("El método aun no ha sido implementado");
    }
}
