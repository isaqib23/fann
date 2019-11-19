<?php

use Illuminate\Database\Seeder;

class NicheTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = public_path() . "/assets/niches.json";
        $niches = json_decode(file_get_contents($path), true);

        foreach ($niches as $key => $niche) {

            DB::table('niches')->insert([
                'name'          => $niche,
            ]);
        }
    }
}
