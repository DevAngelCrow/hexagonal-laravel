<?php

namespace Database\Seeders;

use App\Models\CtlCategoryPermissions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CtlPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $idCategoryPermissions = CtlCategoryPermissions::select('id')->orderBy('id')->get()->all();

        DB::table('ctl_permissions')->insert(
            [
                //PERMISOS DE RUTAS
                [
                    'name' => 'listar-rutas',
                    'description' => 'Lista las rutas para navegar en el sistema',
                    'id_category_permissions' => $idCategoryPermissions[0]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'crear-ruta',
                    'description' => 'Crea la ruta del sistema',
                    'id_category_permissions' => $idCategoryPermissions[0]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'editar-ruta',
                    'description' => 'Edita la ruta del sistema',
                    'id_category_permissions' => $idCategoryPermissions[0]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'ver-ruta',
                    'description' => 'Visualiza la ruta del sistema',
                    'id_category_permissions' => $idCategoryPermissions[0]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'eliminar-ruta',
                    'description' => 'Elimina ruta del sistema',
                    'id_category_permissions' => $idCategoryPermissions[0]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                //PERMISOS DE CATEGORIAS DE PERMISOS
                [
                    'name' => 'crear-categoria-permiso',
                    'description' => 'Crea categoria de permiso',
                    'id_category_permissions' => $idCategoryPermissions[1]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'listar-categorias-permisos',
                    'description' => 'Lista las categorias de permisos',
                    'id_category_permissions' => $idCategoryPermissions[1]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'editar-categoria-permisos',
                    'description' => 'Edita la categoria del permiso',
                    'id_category_permissions' => $idCategoryPermissions[1]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'ver-categoria-permiso',
                    'description' => 'Ve registro de categoria de permiso',
                    'id_category_permissions' => $idCategoryPermissions[1]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'eliminar-categoria-permiso',
                    'description' => 'Elimina categoria de permiso',
                    'id_category_permissions' => $idCategoryPermissions[1]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                //PERMISOS
                [
                    'name' => 'crear-permiso',
                    'description' => 'Crea permiso',
                    'id_category_permissions' => $idCategoryPermissions[2]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'listar-permisos',
                    'description' => 'Lista los permisos del sistema',
                    'id_category_permissions' => $idCategoryPermissions[2]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'editar-permiso',
                    'description' => 'Edita el permiso',
                    'id_category_permissions' => $idCategoryPermissions[2]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'ver-permiso',
                    'description' => 'Ver el registro del permiso',
                    'id_category_permissions' => $idCategoryPermissions[2]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'eliminar-permiso',
                    'description' => 'Elimina permiso del sistema',
                    'id_category_permissions' => $idCategoryPermissions[2]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'crear-rol',
                    'description' => 'Crea un rol',
                    'id_category_permissions' => $idCategoryPermissions[3]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                //Permisos de Roles
                [
                    'name' => 'listar-roles',
                    'description' => 'Lista los roles',
                    'id_category_permissions' => $idCategoryPermissions[3]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'editar-rol',
                    'description' => 'Edita el rol',
                    'id_category_permissions' => $idCategoryPermissions[3]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'ver-rol',
                    'description' => 'Ver el registro del rol',
                    'id_category_permissions' => $idCategoryPermissions[3]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'eliminar-rol',
                    'description' => 'Elimina el rol del sistema',
                    'id_category_permissions' => $idCategoryPermissions[3]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                //Permisos de Usuarios-Roles
                [
                    'name' => 'crear-usuario-rol',
                    'description' => 'Crea una relacion de usuario rol',
                    'id_category_permissions' => $idCategoryPermissions[4]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'editar-usuario-rol',
                    'description' => 'Edita la relacion de usuario rol',
                    'id_category_permissions' => $idCategoryPermissions[4]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                //PERMISOS DE VERIFICACION DE CORREO
                [
                    'name' => 'verificar-correo-usuario',
                    'description' => 'Permite verificar el correo electronico del usuario',
                    'id_category_permissions' => $idCategoryPermissions[5]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'solicitar-enlace-verificacion-correo-usuario',
                    'description' => 'Permite solicitar el enlace de verificacion nuevamente',
                    'id_category_permissions' => $idCategoryPermissions[5]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                //PERMISOS DE INICIO DE SESION
                [
                    'name' => 'inicio-sesion',
                    'description' => 'Permite iniciar sesion',
                    'id_category_permissions' => $idCategoryPermissions[6]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                //PERMISOS DE REGISTRO
                [
                    'name' => 'registro-usuario',
                    'description' => 'Permite crear cuenta del usuario para el sistema',
                    'id_category_permissions' => $idCategoryPermissions[7]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                //PERMISOS DE USUARIO
                [
                    'name' => 'crear-usuario',
                    'description' => 'Permite crear un usuario',
                    'id_category_permissions' => $idCategoryPermissions[8]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'ver-usuario-correo',
                    'description' => 'Permite visualizar el registro del usuario por medio del correo electronico',
                    'id_category_permissions' => $idCategoryPermissions[8]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                //PERMISOS DE ESTADOS GLOBALES
                [
                    'name' => 'crear-estado-global',
                    'description' => 'Permite crear un estado global',
                    'id_category_permissions' => $idCategoryPermissions[9]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'listar-estados-globales',
                    'description' => 'Permite listar los estados globles registrados',
                    'id_category_permissions' => $idCategoryPermissions[9]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'editar-estado-global',
                    'description' => 'Permite editar un estado global',
                    'id_category_permissions' => $idCategoryPermissions[9]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'ver-estado-global',
                    'description' => 'Permite ver un estado global',
                    'id_category_permissions' => $idCategoryPermissions[9]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'eliminar-estado-global',
                    'description' => 'Permite eliminar un estado global',
                    'id_category_permissions' => $idCategoryPermissions[9]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                //PERMISOS DE ESTADO CIVIL
                [
                    'name' => 'crear-estado-civil',
                    'description' => 'Permite crear un estado civil',
                    'id_category_permissions' => $idCategoryPermissions[10]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'listar-estados-civiles',
                    'description' => 'Permite listar los estados civiles',
                    'id_category_permissions' => $idCategoryPermissions[10]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'editar-estado-civil',
                    'description' => 'Permite editar un estado civil',
                    'id_category_permissions' => $idCategoryPermissions[10]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'ver-estado-civil',
                    'description' => 'Permite ver un estado civil',
                    'id_category_permissions' => $idCategoryPermissions[10]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'eliminar-estado-civil',
                    'description' => 'Permite eliminar un estado civil',
                    'id_category_permissions' => $idCategoryPermissions[10]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                //PERMISOS DE PAIS
                [
                    'name' => 'crear-pais',
                    'description' => 'Permite crear un pais',
                    'id_category_permissions' => $idCategoryPermissions[11]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'listar-paises',
                    'description' => 'Permite listar paises',
                    'id_category_permissions' => $idCategoryPermissions[11]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'editar-pais',
                    'description' => 'Permite editar un pais',
                    'id_category_permissions' => $idCategoryPermissions[11]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'ver-pais',
                    'description' => 'Permite ver un pais',
                    'id_category_permissions' => $idCategoryPermissions[11]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'eliminar-pais',
                    'description' => 'Permite eliminar un pais',
                    'id_category_permissions' => $idCategoryPermissions[11]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                //PERMISOS DEPARTAMENTO
                [
                    'name' => 'crear-departamento',
                    'description' => 'Permite crear un departamento',
                    'id_category_permissions' => $idCategoryPermissions[12]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'listar-departamentos',
                    'description' => 'Permite listar departamentos',
                    'id_category_permissions' => $idCategoryPermissions[12]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'editar-departamento',
                    'description' => 'Permite editar un departamento',
                    'id_category_permissions' => $idCategoryPermissions[12]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'ver-departamento',
                    'description' => 'Permite ver un departamento',
                    'id_category_permissions' => $idCategoryPermissions[12]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'eliminar-departamento',
                    'description' => 'Permite eliminar un departamento',
                    'id_category_permissions' => $idCategoryPermissions[12]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                //PERMISOS MUNICIPIO
                [
                    'name' => 'crear-municipio',
                    'description' => 'Permite crear un municipio',
                    'id_category_permissions' => $idCategoryPermissions[13]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'listar-municipios',
                    'description' => 'Permite listar municipios',
                    'id_category_permissions' => $idCategoryPermissions[13]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'editar-municipio',
                    'description' => 'Permite editar un municipio',
                    'id_category_permissions' => $idCategoryPermissions[13]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'ver-municipio',
                    'description' => 'Permite ver un municipio',
                    'id_category_permissions' => $idCategoryPermissions[13]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'eliminar-municipio',
                    'description' => 'Permite eliminar un municipio',
                    'id_category_permissions' => $idCategoryPermissions[13]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                //PERMISOS DISTRITOS
                [
                    'name' => 'crear-municipio',
                    'description' => 'Permite crear un distrito',
                    'id_category_permissions' => $idCategoryPermissions[14]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'listar-municipios',
                    'description' => 'Permite listar distritos',
                    'id_category_permissions' => $idCategoryPermissions[14]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'editar-municipio',
                    'description' => 'Permite editar un distrito',
                    'id_category_permissions' => $idCategoryPermissions[14]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'ver-municipio',
                    'description' => 'Permite ver un distrito',
                    'id_category_permissions' => $idCategoryPermissions[14]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'eliminar-municipio',
                    'description' => 'Permite eliminar un distrito',
                    'id_category_permissions' => $idCategoryPermissions[14]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                //PERMISOS DOCUMENTO
                [
                    'name' => 'crear-documento',
                    'description' => 'Permite crear un documento',
                    'id_category_permissions' => $idCategoryPermissions[15]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'listar-documentos',
                    'description' => 'Permite listar documentos',
                    'id_category_permissions' => $idCategoryPermissions[15]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'editar-documento',
                    'description' => 'Permite editar un documento',
                    'id_category_permissions' => $idCategoryPermissions[15]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'ver-documento',
                    'description' => 'Permite ver un documento',
                    'id_category_permissions' => $idCategoryPermissions[15]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'eliminar-documento',
                    'description' => 'Permite eliminar un documento',
                    'id_category_permissions' => $idCategoryPermissions[15]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                //PERMISOS TIPO DOCUMENTO
                [
                    'name' => 'crear-tipo-documento',
                    'description' => 'Permite crear un tipo de documento',
                    'id_category_permissions' => $idCategoryPermissions[16]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'listar-tipos-documentos',
                    'description' => 'Permite listar los tipos de documentos',
                    'id_category_permissions' => $idCategoryPermissions[16]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'editar-tipo-documento',
                    'description' => 'Permite editar un tipo de documento',
                    'id_category_permissions' => $idCategoryPermissions[16]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'ver-tipo-documento',
                    'description' => 'Permite ver un tipo de documento',
                    'id_category_permissions' => $idCategoryPermissions[16]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'eliminar-tipo-documento',
                    'description' => 'Permite eliminar un tipo de documento',
                    'id_category_permissions' => $idCategoryPermissions[16]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                //PERMISOS DIRECCION
                [
                    'name' => 'crear-direccion',
                    'description' => 'Permite crear una direccion',
                    'id_category_permissions' => $idCategoryPermissions[17]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'listar-direcciones',
                    'description' => 'Permite listar direcciones',
                    'id_category_permissions' => $idCategoryPermissions[17]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'editar-direccion',
                    'description' => 'Permite editar una direccion',
                    'id_category_permissions' => $idCategoryPermissions[17]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'ver-direccion',
                    'description' => 'Permite ver una direccion',
                    'id_category_permissions' => $idCategoryPermissions[17]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'eliminar-direccion',
                    'description' => 'Permite eliminar una direccion',
                    'id_category_permissions' => $idCategoryPermissions[17]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                //PERMISOS PERSONA
                [
                    'name' => 'crear-persona',
                    'description' => 'Permite crear un registro de persona',
                    'id_category_permissions' => $idCategoryPermissions[18]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'listar-personas',
                    'description' => 'Permite listar registros de persona',
                    'id_category_permissions' => $idCategoryPermissions[18]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'editar-persona',
                    'description' => 'Permite editar un registro de persona',
                    'id_category_permissions' => $idCategoryPermissions[18]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'ver-persona',
                    'description' => 'Permite ver un registro de persona',
                    'id_category_permissions' => $idCategoryPermissions[18]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'eliminar-persona',
                    'description' => 'Permite eliminar un registro de persona',
                    'id_category_permissions' => $idCategoryPermissions[18]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                //PERMISOS DE PROVEEDOR DE ALMACENAMIENTO
                [
                    'name' => 'crear-proveedor-almacenamiento',
                    'description' => 'Permite crear un proveedor de almacenamiento',
                    'id_category_permissions' => $idCategoryPermissions[19]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'listar-proveedores-almacenamiento',
                    'description' => 'Permite listar proveedores de almacenamiento',
                    'id_category_permissions' => $idCategoryPermissions[19]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'editar-proveedor-almacenamiento',
                    'description' => 'Permite editar un proveedor de almacenamiento',
                    'id_category_permissions' => $idCategoryPermissions[19]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'ver-proveedor-almacenamiento',
                    'description' => 'Permite ver un proveedor de almacenamiento',
                    'id_category_permissions' => $idCategoryPermissions[19]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                [
                    'name' => 'eliminar-proveedor-almacenamiento',
                    'description' => 'Permite eliminar un proveedor de almacenamiento',
                    'id_category_permissions' => $idCategoryPermissions[19]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                //PERMISOS DE DESTINO DE ALMACENAMIENTO
                [
                    'name' => 'subir-multimedia-almacenamiento',
                    'description' => 'Permite subir un registro de archivo multimedia',
                    'id_category_permissions' => $idCategoryPermissions[20]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                //PERMISOS DEL LAYOUT
                [
                    'name' => 'ver-layout',
                    'description' => 'Permite ver el layout del sistema',
                    'id_category_permissions' => $idCategoryPermissions[21]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                //PERMISOS PARA LA VISTA TEST
                [
                    'name' => 'ver-test-components',
                    'description' => 'Permite ver la vista para testear componentes',
                    'id_category_permissions' => $idCategoryPermissions[22]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                //PERMISOS PARA EL TABLERO
                [
                    'name' => 'ver-tablero',
                    'description' => 'Permite ver la vista del tablero',
                    'id_category_permissions' => $idCategoryPermissions[23]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
                //PERMISO MENU USUARIO
                [
                    'name' => 'ver-menu-usuario',
                    'description' => 'Permite ver los elementos desplegables del menu usuario del avatar',
                    'id_category_permissions' => $idCategoryPermissions[24]->id,
                    'created_at' => now(),
                    'active' => true,
                ],
            ]
        );
    }
}
