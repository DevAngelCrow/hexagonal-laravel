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
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $routes = MntRoute::select('id')->orderBy('id')->get()->all();
        $permissions = CtlPermissions::select('id', 'id_category_permissions')->orderBy('id')->get()->all();
        $categories = CtlCategoryPermissions::select('id')->orderBy('id')->get()->all();
        $collection = array_map(function ($route) use ($categories, $permissions) {
            return array_reduce($categories, function ($carry, $category) use ($permissions, $route) {
                foreach ($permissions as $permission) {
                    if ($category->id === $permission->id_category_permissions) {
                        $carry[] = [
                            "id_route"      => $route->id,
                            "id_permission" => $permission->id,
                        ];
                    }
                }
                return $carry;
            }, []);
        }, $routes);

        $flattened = Arr::flatten($collection, 1);
        DB::table('mnt_route_permissions')->insert(
            $flattened,
        );
    }
}
