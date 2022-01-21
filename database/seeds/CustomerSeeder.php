<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(47, 56) as $index) {
            $gender = $faker->randomElement(['male', 'female']);
            $first_name = $faker->randomElement(['jimmy', 'hokkit', 'kahseng', 'xinjun', 'yilun', 'yiyun', 'vincent', 'junkiet', 'siyi', 'tuckyew', 'layseng', 'saihoe']);
            $last_name = $faker->randomElement(['tay', 'lim', 'wong', 'kim', 'tan', 'liew', 'tham', 'lee', 'low', 'poh', 'tee', 'toh']);
    
            DB::table('customers')->insert([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'gender' => $gender,
                'date_of_birth' => $faker->dateTimeBetween('1990-01-01', '2000-12-31')->format('Y-m-d'),
                'contact_number' => $faker->numerify('65-########'),
                'email' => $first_name.'@gmail.com',
            ]);
        }
    }
}
