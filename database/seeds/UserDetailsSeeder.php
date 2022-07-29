<?php

use App\Models\User;
use App\Models\UserDetails;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class UserDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = User::all();

        foreach ($users as $user) {
            UserDetails::create([
                'user_id'   => $user->id,
                'address'   => $faker->address(),
                'phone'     => $faker->phoneNumber(),
                'birth'     => $faker->date(),
            ]);
        }
    }
}
