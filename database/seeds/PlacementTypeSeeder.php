<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Class PlacementTypeSeeder
 */
class PlacementTypeSeeder extends Seeder
{
    /**
     * @var array
     *
     */
    private $types  = [
        1 => 'Story',
        2 => 'Post',
        3 => 'Video'
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

            \DB::table('placement_types')->insert([
                'name' => $type,
                'slug' => Str::slug($type),
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ]);
        }
    }
}
