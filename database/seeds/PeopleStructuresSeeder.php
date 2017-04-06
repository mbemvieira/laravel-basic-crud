<?php

use Illuminate\Database\Seeder;

class PeopleStructuresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = App\User::where('cpf', '12345678901')->first();

        factory(App\Person::class, 20)->create([
            'user_id' => $admin->id
        ]);

        $people = App\Person::all();

        foreach ($people as $person) {
            factory(App\Email::class, 2)->create([
                'person_id' => $person->id
            ]);
            factory(App\Telephone::class, 2)->create([
                'person_id' => $person->id
            ]);
        }
    }
}
