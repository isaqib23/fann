<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class InfluencerEntireStatisticsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,10) as $index) {
            $dt = Carbon::now();
            $dateNow = $dt->toDateTimeString();

            DB::table('influencer_entire_statistics')->insertGetId([
                'platform_id'               => $faker->numberBetween(1,2),
                'user_id'                   => $faker->numberBetween(11,20),
                'rating'                    => $faker->randomNumber(2),
                'eng_rate'                  => $faker->randomNumber(2),
                'work_rate'                 => $faker->randomNumber(2),
                'tags'                      => $faker->randomNumber(2),
                'post_count'                => $faker->randomNumber(2),
                'comment_count'             => $faker->randomNumber(2),
                'like_count'                => $faker->randomNumber(2),
                'follower_count'            => $faker->randomNumber(2),
                'following_count'           => $faker->randomNumber(2),
                'created_at'                => $dateNow,
                'updated_at'                => $dateNow
            ]);
        }
    }
}
