<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Class PlacementSeeder
 */
class PlacementSeeder extends Seeder
{
    /**
     * @var array
     *
     */
    private $types  = [
        1 => 'Instagram',
        2 => 'Youtube'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->types as  $index => $type) {
            $dt = Carbon::now();
            $dateNow = $dt->toDateTimeString();

            \DB::table('placements')->insert([
                'name' => $type,
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ]);
        }
    }
}
