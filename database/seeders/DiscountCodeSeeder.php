<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DiscountCode;
use Carbon\Carbon;

class DiscountCodeSeeder extends Seeder
{
    public function run(): void
    {
        DiscountCode::insert([
            ['code' => 'GIAM10', 'amount' => 10000, 'expires_at' => Carbon::now()->addDays(7)],
            ['code' => 'GIAM20', 'amount' => 20000, 'expires_at' => Carbon::now()->addDays(10)],
            ['code' => 'GOODDAY', 'amount' => 15000, 'expires_at' => Carbon::now()->addDays(5)],
        ]);
    }
}
