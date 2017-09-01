<?php

use Illuminate\Database\Seeder;

class ACLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::get();

        // Roles
        $admin_role = DB::table('roles')->insertGetId([
            'name' => 'admin',
            'description' => 'Administrador',
            'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $normal_role = DB::table('roles')->insertGetId([
            'name' => 'normal',
            'description' => 'Papel básico',
            'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);

        foreach ($users as $user) {
            $user->roles()->attach([$admin_role, $normal_role]);
        }

        // Permissions
        $view_permission = DB::table('permissions')->insertGetId([
            'name' => 'view_person',
            'description' => 'Visualizar pessoa',
            'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $update_permission = DB::table('permissions')->insertGetId([
            'name' => 'update_person',
            'description' => 'Atualizar pessoa',
            'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $delete_permission = DB::table('permissions')->insertGetId([
            'name' => 'delete_person',
            'description' => 'Deletar pessoa',
            'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $roles = App\Role::get();

        foreach ($roles as $role) {
            $role->permissions()->attach([$view_permission, $update_permission, $delete_permission]);
        }
    }
}
