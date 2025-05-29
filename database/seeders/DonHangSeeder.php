<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DonHang;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DonHangSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            DonHang::create([
                'user_id' => $faker->numberBetween(1, 20),
                'sanpham_id' => $faker->numberBetween(1, 100),
                'ngaydat' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'tongtien' => $faker->randomFloat(2, 10000, 1000000),
            ]);
        }
    }
}
