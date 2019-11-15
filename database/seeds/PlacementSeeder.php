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
        1 => [
            'name' => 'Instagram',
            'image' => 'mdi-instagram'
        ],
        2 => [
            'name' =>  'Youtube',
            'image' => 'mdi-youtube',
        ]
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
                'id'   => $index,
                'name' => $type['name'],
                'slug' => Str::slug($type['name']),
                'image' => $type['image'],
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ]);
        }
    }
}
