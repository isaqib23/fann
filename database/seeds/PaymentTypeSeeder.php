<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Class PaymentTypeSeeder
 */
class PaymentTypeSeeder extends Seeder
{
    /**
     * @var array
     *
     */
    private $types  = [
        1 => 'Paid',
        2 => 'Barter'
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

            \DB::table('payment_types')->insert([
                'name' => $type,
                'slug' => Str::slug($type),
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ]);
        }
    }
}
