<?php

namespace Database\Seeders;

use App\Models\MntRoute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MntRouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('mnt_route')->insert(
            //PARENTS ROUTES
            [
                [
                    'name'=>'login',
                    'description'=>'Ruta para inicio de sesion',
                    'icon'=>'pi pi-sign-in',
                    'uri'=>'/login',
                    'active'=>true,
                    'show'=>false,
                    'order'=>1,
                    'id_parent'=>null,
                    'requiredAuth' => false,
                    'title' => 'Inicio de sesión'
                ],
                [
                    'name'=>'sign-up',
                    'description'=>'Ruta para registrarse en el sistema con un nuevo usuario',
                    'icon'=>'pi pi-user-plus',
                    'uri'=>'/sign-up',
                    'active'=>true,
                    'show'=>false,
                    'order'=>1,
                    'id_parent'=>null,
                    'requiredAuth' => false,
                    'title' => 'Registro de cuenta de usuario'
                ],
                [
                    'name'=>'layout',
                    'description'=>'Ruta para ingresar a la vista principal del sistema',
                    'icon'=>'pi pi-home',
                    'uri'=>'/',
                    'active'=>true,
                    'show'=>true,
                    'order'=>1,
                    'id_parent'=>null,
                    'requiredAuth' => true,
                    'title' => 'Layout vista principal'
                ],
                [
                    'name'=>'forbidden',
                    'description'=>'Ruta de vista no encontrada',
                    'icon'=>'pi pi-exclamation-circle',
                    'uri'=>'/forbidden',
                    'active'=>true,
                    'show'=>false,
                    'order'=>1,
                    'id_parent'=>null,
                    'requiredAuth' => false,
                    'title' => 'Vista no encontrada'
                ],
                [
                    'name'=>'verify-email',
                    'description'=>'Ruta para verificacion de correo electronico',
                    'icon'=>'pi pi-verified',
                    'uri'=>'/verify-email',
                    'active'=>true,
                    'show'=>false,
                    'order'=>1,
                    'id_parent'=>null,
                    'requiredAuth' => false,
                    'title' => 'Vista de verificación de correo de usuario'
                ],
                [
                    'name'=>'pending-verification-email',
                    'description'=>'Ruta para verificacion de correo electronico',
                    'icon'=>'pi pi-envelope',
                    'uri'=>'/pending-verification-email',
                    'active'=>true,
                    'show'=>false,
                    'order'=>1,
                    'id_parent'=>null,
                    'requiredAuth' => false,
                    'title' => 'Pantalla de información para verificar correo de usuario'
                ],
                [
                    'name'=>'Usuario',
                    'description'=>'Menu del usuario',
                    'icon'=>'pi pi-directions',
                    'uri'=>'/usuario-prueba',
                    'active'=>true,
                    'show'=>true,
                    'order'=>1,
                    'id_parent'=> null,
                    'requiredAuth' => true,
                    'title' => 'Usuario'
                ],
            ]
        );

        $routes = MntRoute::select('id')->orderBy('id')->get()->all();

        DB::table('mnt_route')->insert(
            [
                [
                    'name'=>'test-view',
                    'description'=>'Ruta para probar los componentes en modo desarrollo',
                    'icon'=>'pi pi-sliders-v',
                    'uri'=>'/test-view',
                    'active'=>true,
                    'show'=>true,
                    'order'=>2,
                    'id_parent'=> $routes[2]->id,
                    'requiredAuth' => true,
                    'title' => 'Vista para testear componentes'
                ],
                [
                    'name'=>'dashboard',
                    'description'=>'Ruta del tablero',
                    'icon'=>'pi pi-objects-column',
                    'uri'=>'/dashboard',
                    'active'=>true,
                    'show'=>true,
                    'order'=>2,
                    'id_parent'=> $routes[2]->id,
                    'requiredAuth' => true,
                    'title' => 'Vista del tablero principal'
                ],
                [
                    'name'=>'routes-administration',
                    'description'=>'Ruta del administrador de rutas',
                    'icon'=>'pi pi-directions',
                    'uri'=>'/routes-administration',
                    'active'=>true,
                    'show'=>true,
                    'order'=>2,
                    'id_parent'=> $routes[2]->id,
                    'requiredAuth' => true,
                    'title' => 'Vista de administración de rutas'
                ],
                [
                    'name'=>'Correo',
                    'description'=>'Menu del usuario',
                    'icon'=>'pi pi-directions',
                    'uri'=>'/usuario-prueba',
                    'active'=>true,
                    'show'=>true,
                    'order'=>2,
                    'id_parent'=> $routes[6]->id,
                    'requiredAuth' => true,
                    'title' => 'Usuario'
                ],
            ]
        );
    }
}
