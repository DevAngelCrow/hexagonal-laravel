<?php
namespace Src\modules\security\domain\entities\user_role;

use App\Models\UserRol;
use Src\modules\security\domain\exceptions\RoutesException;
use Src\modules\security\domain\value_objects\user_role_value_object\UserRoleId;
use Src\modules\security\domain\value_objects\user_role_value_object\UserRoleIdUser;
use Src\modules\security\domain\value_objects\user_role_value_object\UserRoleIdRol;

class UserRole {
    private readonly UserRoleIdUser $id_user;
        
    private readonly ?UserRoleIdRol $roleIds;
    private readonly ?UserRoleId $id;

    public function __construct(UserRoleIdUser $id_user,  ?UserRoleIdRol $roleIds = null, ?UserRoleId $id = null)
    {
        $this->id_user = $id_user;
        $this->roleIds = $roleIds;
        $this->id = $id;

        //    if(empty($this->roleIds)){
        //     foreach($this->roleIds as $roleId){
        //         if(!$roleId instanceof UserRoleIdRol){
        //             throw new RoutesException("La instancia de cada elemento debe ser de tipo UserRoleIdRol");
        //         }
        //     }
        // }
    }

     public function getIdUser(): UserRoleIdUser
    {
        return $this->id_user;
    }

    public function getIdRol(): UserRoleIdRol
    {
        return $this->roleIds;
    }

    public function getId(): ?UserRoleId
    {
        return $this->id;
    }

}