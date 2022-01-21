<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PurchaseTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        

            $date = Carbon::create(2021, 1, 28, 0, 0, 0);

            DB::table('purchase_transactions')->insert([
                'customer_id' => 51,
                'total_spent' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 5000),
                'total_saving' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 5000),
                'transaction_at' => Carbon::create(2022, 1, 13, 0, 0, 0),
            ]);
            DB::table('purchase_transactions')->insert([
                'customer_id' => 51,
                'total_spent' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 5000),
                'total_saving' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 5000),
                'transaction_at' => Carbon::create(2022, 1, 10, 0, 0, 0),
            ]);
            DB::table('purchase_transactions')->insert([
                'customer_id' => 51,
                
                'total_spent' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 5000),
                'total_saving' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 5000),
                'transaction_at' => Carbon::create(2022, 1, 12, 0, 0, 0),
            ]);
            DB::table('purchase_transactions')->insert([
                'customer_id' => 49,
                'total_spent' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 5000),
                'total_saving' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 5000),
                'transaction_at' => Carbon::create(2022, 1, 17, 0, 0, 0),
            ]);
            DB::table('purchase_transactions')->insert([
                'customer_id' => 47,
                'total_spent' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 5000),
                'total_saving' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 5000),
                'transaction_at' => Carbon::create(2021, 11, 13, 0, 0, 0),
            ]);
            DB::table('purchase_transactions')->insert([
                'customer_id' => 55,
                'total_spent' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 5000),
                'total_saving' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 5000),
                'transaction_at' => Carbon::create(2022, 1, 1, 0, 0, 0),
            ]);
            DB::table('purchase_transactions')->insert([
                'customer_id' => 53,
                'total_spent' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 5000),
                'total_saving' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 5000),
                'transaction_at' => Carbon::create(2021, 12, 13, 0, 0, 0),
            ]);
            DB::table('purchase_transactions')->insert([
                'customer_id' => 56,
                'total_spent' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 5000),
                'total_saving' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 5000),
                'transaction_at' => Carbon::create(2021, 5, 13, 0, 0, 0),
            ]);
            DB::table('purchase_transactions')->insert([
                'customer_id' => 49,
                'total_spent' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 5000),
                'total_saving' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 5000),
                'transaction_at' => Carbon::create(2022, 1, 16, 0, 0, 0),
            ]);
            DB::table('purchase_transactions')->insert([
                'customer_id' => 49,
                'total_spent' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 5000),
                'total_saving' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 5000),
                'transaction_at' => Carbon::create(2022, 1, 15, 0, 0, 0),
            ]);
    }
}
