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
        1 => [
            'name' => 'Product Placement',
            'image' => '/images/icons/balloon.svg'
        ],
        2 => [
            'name' =>  'Brand Awareness',
            'image' => '/images/icons/awareness.svg',
        ],
        3 => [
            'name'  => 'Sponsored Content',
            'image' => '/images/icons/sponsor.svg',
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->categories as $categoryId => $category) {
            $dt = Carbon::now();
            $dateNow = $dt->toDateTimeString();

            DB::table('campaign_objective_categories')->insert([
                'id'   => $categoryId,
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'image' => $category['image'],
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ]);
        }
    }
}
