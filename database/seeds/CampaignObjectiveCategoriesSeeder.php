<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Class CampaignObjectiveCategoriesSeeder
 */
class CampaignObjectiveCategoriesSeeder extends Seeder
{
    private $categories  = [
        'Product Placement',
        'Brand Awareness',
        'Sponsored Content'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->categories as $category) {
            $dt = Carbon::now();
            $dateNow = $dt->toDateTimeString();

            DB::table('campaign_objective_categories')->insert([
                'name' => $category,
                'slug' => Str::slug($category),
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ]);
        }
    }
}
