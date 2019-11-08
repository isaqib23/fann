<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CampaignObjectiveCategoriesSeeder::class);
         $this->call(CampaignObjectiveSeeder::class);
         $this->call(PaymentTypeSeeder::class);
         $this->call(PlacementSeeder::class);
    }
}
