<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 1)->create();

        DB::table('users')->insert([
            'name' => 'Teste Teste',
            'cpf' => '12345678901',
            'email' => 'teste@teste.com.br',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10),
            'last_access' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
