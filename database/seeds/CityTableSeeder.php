<?php

use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/assets/cities.json";
        $cities = json_decode(file_get_contents($path), true);

        foreach ($cities['cities'] as $key => $city) {
            $get_state = DB::table('states')->where('id',$city['state_id'])->first();
            if($get_state != Null) {
                DB::table('cities')->insert([
                    'name' => $city['name'],
                    'state_id' => $city['state_id'],
                ]);
            }
        }
    }
}
