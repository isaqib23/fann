<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;
class TouchPointProductTableSeeder extends Seeder
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

            DB::table('campaign_touch_point_products')->insertGetId([
                'name'                          => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'outside_product_id'            => $faker->randomNumber($nbDigits = NULL, $strict = false),
                'outside_product_link'          => $faker->url,
                'outside_product_variant_id'    => $faker->randomNumber($nbDigits = NULL),
                'outside_platform'              => 'Shopify',
                'outside_product_image'         => $faker->imageUrl($width = 640, $height = 480),
                'created_at'        => $dateNow,
                'updated_at'        => $dateNow
            ]);
        }
    }
}
