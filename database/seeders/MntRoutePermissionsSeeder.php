<?php

namespace Database\Seeders;

use App\Models\CtlCategoryPermissions;
use App\Models\CtlPermissions;
use App\Models\MntRoute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class MntRoutePermissionsSeeder extends Seeder
{
    /**
     * Mapa de permisos de las rutas.
     * La estructura es:
     * 'NombreDeCategoria' => [
     * 'nombre_de_la_ruta' => [
     * 'permiso-1',
     * 'permiso-2',
     * // ...
     * ]
     * ]
     */
    private array $permissionsMap = [
        'Rutas' => [
            'routes-administration' => [
                'listar-rutas',
                'crear-ruta',
                'editar-ruta',
                'ver-ruta',
                'eliminar-ruta'
            ]
        ],
        'Categoria de permiso' => [

            'crear-categoria-permiso',
            'listar-categorias-permisos',
            'editar-categoria-permiso',
            'ver-categoria-permiso',
            'eliminar-categoria-permiso'
        ],
        'Permisos' => [
            'crear-permiso',
            'listar-permisos',
            'editar-permiso',
            'ver-permiso',
            'eliminar-permiso'
        ],
        'Roles' => [
            'crear-rol',
            'listar-roles',
            'editar-rol',
            'ver-rol',
            'eliminar-rol'
        ],
        'Usuarios-Roles' => [
            'crear-usuario-rol',
            'editar-usuario-rol'
        ],
        'Verificacion de correo' => [
            'verify-email' => [
                'verificar-correo-usuario',

            ],
            'pending-verification-email' => [
                'solicitar-enlace-verificacion-correo-usuario'
            ]
        ],
        'Inicio de sesion' => [
            'login' => [
                'inicio-sesion',
            ]
        ],
        'Registro' => [
            'sign-up' => [
                'registro-usuario'
            ]
        ],
        'Layout' => [
            'layout' => [
                'ver-layout'
            ]
        ],
        'Test' => [
            'test-view' => [
                'ver-test-components'
            ]
        ],
        'Dashboard' => [
            'dashboard' => [
                'ver-tablero'
            ]
        ],
        'Menu usuario' => [
            'Usuario' => [
                'ver-menu-usuario'
            ]
        ],
        'Usuario' => [
            'crear-usuario',
            'ver-usuario-correo',
            'cerrar-sesion',
            'ver-nombre-usuario-menu'
        ],
        'Estados globales' => [
            'crear-estado-global',
            'listar-estados-globales',
            'editar-estado-global',
            'ver-estado-global',
            'eliminar-estado-global'
        ],
        'Estado civil' => [
            'crear-estado-civil',
            'listar-estados-civiles',
            'editar-estado-civil',
            'ver-estado-civil',
            'eliminar-estado-civil'
        ],
        'Pais' => [
            'crear-pais',
            'listar-paises',
            'editar-pais',
            'ver-pais',
            'eliminar-pais'
        ],
        'Departamento' => [
            'crear-departamento',
            'listar-departamentos',
            'editar-departamento',
            'ver-departamento',
            'eliminar-departamento'
        ],
        'Municipio' => [
            'crear-municipio',
            'listar-municipio',
            'editar-municipio',
            'ver-municipio',
            'eliminar-municipio'
        ],
        'Distrito' => [
            'crear-distrito',
            'listar-distrito',
            'editar-distrito',
            'ver-distrito',
            'eliminar-distrito'
        ],
        'Documento' => [
            'crear-documento',
            'listar-documentos',
            'editar-documentos',
            'ver-documento',
            'eliminar-documento'
        ],
        'Tipo de documento' => [
            'crear-tipo-documento',
            'listar-tipos-documentos',
            'editar-tipo-documento',
            'ver-tipo-documento',
            'eliminar-tipo-documento'
        ],
        'Direccion' => [
            'crear-direccion',
            'listar-direcciones',
            'editar-direccion',
            'ver-direccion',
            'eliminar-direccion'
        ],
        'Persona' => [
            'crear-persona',
            'listar-personas',
            'editar-persona',
            'ver-persona',
            'eliminar-persona',
            'ver-persona-email'
        ],
        'Proveedor de almacenamiento' => [
            'crar-proveedor-almacenamiento',
            'listar-proveedores-almacenamientos',
            'editar-proveedor-almacenamiento',
            'ver-proveedor-almacenamiento',
            'eliminar-proveedor-almacenamiento',
        ],
        'Destino de almacenamiento' => [
            'subir-multimedia-almacenamiento'
        ]
    ];
    public function run(): void
    {
        DB::table('mnt_route_permissions')->truncate();
        $this->command->info("Asignando permisos a las rutas según el mapa definido...");

        foreach ($this->permissionsMap as $categoryName => $routes) {

            $category = CtlCategoryPermissions::where('name', $categoryName)->first();
            if (!$category) {
                $this->command->warn(" > [!] Advertencia: La categoría de permisos '{$categoryName}' no fue encontrada en la BD. Saltando...");
                continue;
            }

            foreach ($routes as $routeName => $permissionNames) {
                $route = MntRoute::where('name', $routeName)->first();
                if (!$route) {
                    // $this->command->warn(" > [!] Advertencia: La ruta '{$routeName}' no fue encontrada en la BD. Saltando...");
                    continue;
                }

                $permissionsIds = CtlPermissions::where('id_category_permissions', $category->id)->whereIn('name', $permissionNames)->pluck('id');
                if ($permissionsIds->isEmpty()) {
                    //$this->command->warn(" > [!] Advertencia: No se encontraron permisos para la ruta '{$routeName}' en la categoría '{$categoryName}'.");
                    continue;
                }

                $dataToInsert = $permissionsIds->map(function ($permissionId) use ($route) {
                    return [
                        'id_route' => $route->id,
                        'id_permission' => $permissionId
                    ];
                })->all();

                DB::table('mnt_route_permissions')->insert($dataToInsert);
                $this->command->info(" > Ruta '{$routeName}': " . count($dataToInsert) . " permisos asignados correctamente.");
            }
        }
        $this->command->info("¡Siembra de permisos de ruta completada!");
    }
}
