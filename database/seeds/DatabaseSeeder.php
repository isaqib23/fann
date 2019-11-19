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
         $this->call(PlacementTypeSeeder::class);
         $this->call(CountriesTableSeeder::class);
         $this->call(StateTableSeeder::class);
         $this->call(CityTableSeeder::class);
         $this->call(NicheTableSeeder::class);
    }
}
