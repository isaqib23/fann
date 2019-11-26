<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class UserPlatformSeeder extends Seeder
{
    /**
     * @var Platforms array
     *
     */

    private $platforms = [
        'instagram', 'youtube'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->platforms as  $key => $platform) {
            $dt = Carbon::now();
            $dateNow = $dt->toDateTimeString();
            \DB::table('user_platforms')->insert([
                'name' => $platform,
                'slug' => Str::slug($platform),
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ]);
        }
    }
}
