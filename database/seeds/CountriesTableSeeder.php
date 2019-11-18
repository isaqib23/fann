<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = public_path() . "/assets/countries.json";
        $countries = json_decode(file_get_contents($path), true);

        foreach ($countries['countries'] as $key => $country) {

            DB::table('countries')->insert([
                'name'          => $country['name'],
                'sort_name'      => $country['sortname'],
                'phone_code'     => $country['phoneCode'],
                'flag'          => 'flag-of-'.str_replace(' ', '_', $country['name']).'.jpg'
            ]);
        }
    }
}
