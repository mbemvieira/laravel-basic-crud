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
        $users = App\User::get();

        foreach ($users as $user) {
            $user->people()->saveMany( factory(App\Person::class, 20)->make() );
        }

        // $people = App\Person::all();

        // foreach ($people as $person) {
        //     factory(App\Email::class, 2)->create([
        //         'person_id' => $person->id
        //     ]);
        //     factory(App\Telephone::class, 2)->create([
        //         'person_id' => $person->id
        //     ]);
        // }
    }
}
