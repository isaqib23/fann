<?php

use Illuminate\Database\Seeder;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/assets/states.json";
        $states = json_decode(file_get_contents($path), true);

        foreach ($states['states'] as $key => $state) {
            
            DB::table('states')->insert([
                'id'          => $state['id'],
                'name'          => $state['name'],
                'country_id'      => $state['country_id'],
            ]);
        }
    }
}
