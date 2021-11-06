<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::updateOrCreate(["role"=>'SUPERADMIN',"status"=>1]);
        Role::updateOrCreate(["role"=>'ADMIN']);
        Role::updateOrCreate(["role"=>'EDITOR']);
        Role::updateOrCreate(["role"=>'VENDOR']);
        Role::updateOrCreate(["role"=>'CUSTOMER']);
    }
}
