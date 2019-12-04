<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class CampaignTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        static $campaign = 1001;
        static $touchPoint = 1001;
        foreach (range(11,30) as $index) {
            $dt = Carbon::now();
            $dateNow = $dt->toDateTimeString();

            $last_id = \DB::table('campaigns')->insertGetId([
                'id'                => $campaign++,
                'name'              => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'slug'              => $faker->slug,
                'description'       => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'status'            => 'active',
                'touch_points'      => 3,
                'total_amount'      => $faker->randomNumber(2),
                'objective_id'      => $faker->randomElement($array = array ('1','2','3')),
                'impressions'       => $faker->randomNumber(2),
                'actions'           => $faker->randomNumber(2),
                'eng_rate'          => $faker->randomNumber(2),
                'created_at'        => $dateNow,
                'updated_at'        => $dateNow
            ]);

            for ($i=0; $i<=2; $i++){
                DB::table('campaign_touch_points')->insertGetId([
                    'id'                => $touchPoint++,
                    'name'              => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    'description'       => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                    'dispatch_product'  => $faker->numberBetween(1,10),
                    'barter_product'    => $faker->numberBetween(1,10),
                    'campaign_id'       => $last_id,
                    'placement_id'      => $faker->randomElement($array = array ('1','2')),
                    'barter_as_dispatch'=> $faker->randomElement($array = array ('1','2','3')),
                    'amount'            => $faker->randomNumber(2),
                    'created_at'        => $dateNow,
                    'updated_at'        => $dateNow
                ]);
            }
        }
    }
}
