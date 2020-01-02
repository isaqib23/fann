<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class InfluencerCampaignStatisticsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        static $campaign = 1001;
        $faker = Faker::create();
        foreach (range(1,10) as $index) {
            $dt = Carbon::now();
            $dateNow = $dt->toDateTimeString();

            DB::table('campaign_assigned_jobs')->insertGetId([
                'placement_id'              => $faker->numberBetween(1,2),
                'user_id'                   => $faker->numberBetween(11,20),
                'campaign_invite_id'        => $faker->numberBetween(1,20),
                'campaign_id'               => $campaign++,
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
