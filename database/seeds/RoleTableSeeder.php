<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'ADM';
        $role->description = 'Administrator';
        $role->save();
        $role = new Role();
        $role->name = 'Empleado';
        $role->description = 'Empleado';
        $role->save();
    }
}
