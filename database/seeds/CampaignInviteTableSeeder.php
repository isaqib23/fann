<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class CampaignInviteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        static $campaign = 1001;
        static $touchPoint = 1001;
        $faker = Faker::create();
        foreach (range(1,20) as $index) {
            $dt = Carbon::now();
            $dateNow = $dt->toDateTimeString();

            $last_id = DB::table('campaign_invites')->insertGetId([
                'user_id'           => $faker->numberBetween(21,30),
                'campaign_id'       => $campaign++,
                'touch_point_id'    => $touchPoint++,
                'sender_id'         => $faker->numberBetween(11,20),
                'sent_from'         => ($index >= 20) ? 'businessOwner' : 'influencer',
                'original_price'    => $faker->randomNumber(2),
                'influencer_price'  => $faker->randomNumber(2),
                'status'            => 'active',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ]);

            $get_campaign_invite = DB::table('campaign_invites')->where('id',$last_id)->first();

            DB::table('campaign_offers')->insertGetId([
                'user_id'           => $get_campaign_invite->user_id,
                'campaign_id'       => $get_campaign_invite->campaign_id,
                'touch_point_id'    => $get_campaign_invite->touch_point_id,
                'status'            => 'active',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ]);

            DB::table('influencer_jobs')->insertGetId([
                'user_id'            => $get_campaign_invite->user_id,
                'campaign_invite_id' => $get_campaign_invite->id,
                'status'             => 'active',
                'created_at'         => $dateNow,
                'updated_at'         => $dateNow
            ]);
        }
    }
}
