<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CtlCategoryPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('ctl_category_permissions')->insert([
            [
                'name' => 'Rutas',
                'description' => 'Para las rutas del sistema',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Categoria de permiso',
                'description' => 'Categoria del permiso',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Permisos',
                'description' => 'Permiso',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Roles',
                'description' => 'Categoria para roles',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Usuarios-Roles',
                'description' => 'Roles relacionados a los usuarios',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Verificacion de correo',
                'description' => 'Verificacion de correo electronico',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Inicio de sesion',
                'description' => 'Para el inicio de sesion',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Registro',
                'description' => 'Para el registro del nuevo usuario',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Usuario',
                'description' => 'Creacion de usuario individual',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Estados globales',
                'description' => 'Para los estados dinamicos',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Estado civil',
                'description' => 'Para el estado civil',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Pais',
                'description' => 'Para el catalogo de pais',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Departamento',
                'description' => 'Para el catalogo de departamento',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Municipio',
                'description' => 'Para el catalogo de municipio',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Distrito',
                'description' => 'Para el catalogo de distrito',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Documento',
                'description' => 'Para el registro de documentos de persona',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Tipo de documento',
                'description' => 'Para el catalogo de tipos de documentos',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Direccion',
                'description' => 'Para registro de direcciones de persona',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Persona',
                'description' => 'Para el mantenimiento de personas',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Proveedor de almacenamiento',
                'description' => 'Para el mantenimiento del proveedor de almacenamiento',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Destino de almacenamiento',
                'description' => 'Para el mantenimiento de personas',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Layout',
                'description' => 'Para ver el layout principal',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Test',
                'description' => 'Para la vista de test de componentes',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Dashboard',
                'description' => 'Para la vista de tablero',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Menu usuario',
                'description' => 'Para el menú del usuario que desplega en el avatar',
                'active' => true,
                'created_at' => now(),
            ]
        ]);
    }
}
