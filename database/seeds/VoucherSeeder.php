<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        

        foreach(range(1, 1000) as $index) {

            DB::table('vouchers')->insert([
                'customer_id' => NULL,
                'code' => Str::random(9),
                'status' => 0,
                'reserve_at' => NULL,
                'expired_reserve_at' => NULL,
            ]);
        }
    }
}
