<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Class CampaignObjectiveSeeder
 */
class CampaignObjectiveSeeder extends Seeder
{
    /**
     * @var array
     * array keys 1,2,3 reflected from campaign objective categories
     *
     */
    private $objectives  = [
        1 => [
            'Unboxing',
            'Product Review',
            'Contest & Giveways',
        ],
        2 => [
            'Brand Shoutout',
            'Brand Review',
            'Event Invitation',
        ],
        3 => [
            'Promotional Content',
            'Special Events'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->objectives as  $category => $objective) {
            $dt = Carbon::now();
            $dateNow = $dt->toDateTimeString();
            foreach ($objective as $name ) {
                \DB::table('campaign_objectives')->insert([
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'parent_category_id' => $category,
                    'created_at' => $dateNow,
                    'updated_at' => $dateNow,
                ]);
            }
        }
    }
}
