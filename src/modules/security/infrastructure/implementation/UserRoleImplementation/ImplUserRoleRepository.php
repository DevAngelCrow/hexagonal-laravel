<?php

namespace Src\modules\security\infrastructure\implementation\UserRoleImplementation;

use App\Models\User;
use App\Models\UserRol;
use Exception;
use Src\modules\security\domain\entities\user_role\UserRole;
use Src\modules\security\domain\repositories\user_role\UserRoleRepositoryInterface;
use Src\modules\security\domain\value_objects\user_role_value_object\UserRoleId;
use Src\modules\security\domain\value_objects\user_role_value_object\UserRoleIdRol;
use Src\modules\security\domain\value_objects\user_role_value_object\UserRoleIdUser;
use Src\shared\infrastructure\exceptions\InfrastructureException;
use Symfony\Component\HttpFoundation\Response;


class ImplUserRoleRepository implements UserRoleRepositoryInterface
{
    private $userRoleArray = [];
    public function create(UserRole $user_role): void
    {
        try {
            foreach ($user_role->getIdRol()->values() as $rolId) {
                $userRoleModel = new UserRol();
                $userRoleModel->id_user = $user_role->getIdUser()->value();
                $userRoleModel->id_role = $rolId;
                $userRoleModel->save();
            }
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateOrCreate(UserRole $user_role): void
    {
        try {

            $userId = $user_role->getIdUser()->value();
            $newRoles = $user_role->getIdRol()->values();
            $currentRoles = UserRol::where('id_user', $userId)->pluck('id_role')->toArray();

            $rolesToAdd = array_diff($newRoles, $currentRoles);
            $rolesToDelete = array_diff($currentRoles, $newRoles);

            if (!empty($rolesToDelete)) {
                UserRol::where('id_user', $userId)
                    ->whereIn('id_role', $rolesToDelete)
                    ->delete();
            }

            foreach ($rolesToAdd as $rolId) {
                $userRoleModel = new UserRol();
                $userRoleModel->id_user = $userId;
                $userRoleModel->id_role = $rolId;
                $userRoleModel->save();
            }
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getAll(int $page, int $per_page): array
    {
        try {
            $userRoleModels = UserRol::orderBy("id")->paginate($per_page);
            $data = array_map(fn($item) => $this->mapToDomain($item), $userRoleModels->items());

            $this->userRoleArray = [
                "data" => $data,
                "pagination" => [
                    "current_page" => $userRoleModels->currentPage(),
                    "last_page" => $userRoleModels->lastPage(),
                    "per_page" => $userRoleModels->perPage(),
                    "total" => $userRoleModels->total()
                ]
            ];

            return $this->userRoleArray;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getOneById(UserRoleId $id): ?UserRole
    {
        try {

            $userRoleModel = UserRol::find($id->value());

            if (!$userRoleModel) {
                throw new InfrastructureException("Identificador de usuario-rol no encontrado", Response::HTTP_NOT_FOUND);
            }
            return $this->mapToDomain($userRoleModel);
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    private function mapToDomain(UserRol $userRoleModel): UserRole
    {
        $rolIds = is_array($userRoleModel->rol_id) ? $userRoleModel->rol_id : [$userRoleModel->rol_id];

        $userRolMapped = new UserRole(
            new UserRoleIdUser($userRoleModel->user_id),
            new UserRoleIdRol($rolIds),
            new UserRoleId($userRoleModel->id),
        );
        return $userRolMapped;
    }
    
}
