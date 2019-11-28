<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,20) as $index) {
            $dt = Carbon::now();
            $dateNow = $dt->toDateTimeString();

            DB::table('users')->insertGetId([
                'first_name'            => $faker->firstName,
                'last_name'             => $faker->lastName,
                'email'                 => $faker->freeEmail,
                'type'                  => ($index >= 10) ? 'businessOwner' : 'influencer',
                'password'              => bcrypt('123456')
            ]);
        }
    }
}
