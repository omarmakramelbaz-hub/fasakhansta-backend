<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
      /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'dashboard',

            'edit settings',

            'banners list',
            'create banner',
            'show banner',
            'edit banner',
            'delete banner',

            'car_brands list',
            'create car_brand',
            'show car_brand',
            'edit car_brand',
            'delete car_brand',

            'car_models list',
            'create car_model',
            'show car_model',
            'edit car_model',
            'delete car_model',

            'categories list',
            'create category',
            'show category',
            'edit category',
            'delete category',

            'ad_categories list',
            'create ad_category',
            'show ad_category',
            'edit ad_category',
            'delete ad_category',




            'offers list',
            'create offer',
            'show offer',
            'edit offer',
            'delete offer',

            'users list',
            'create user',
            'show user',
            'edit user',
            'delete user',

            'countries list',
            'create country',
            'show country',
            'edit country',
            'delete country',

            'cities list',
            'create city',
            'show city',
            'edit city',
            'delete city',

            'role-list',
            'role-create',
            'role-show',
            'role-edit',
            'role-delete',

            'admin-list',
            'admin-create',
            'admin-show',
            'admin-edit',
            'admin-delete',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}