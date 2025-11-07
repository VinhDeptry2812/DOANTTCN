<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VoucherSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('vouchers')->insert([
            [
                'code' => 'SALE10',
                'name' => 'Giảm 10% cho tất cả đơn hàng',
                'type' => 'percent',
                'value' => 10,
                'max_discount' => 50000,
                'min_order_value' => 0,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonth(),
                'usage_limit' => 200,
                'usage_count' => 0,
                'status' => 1,
            ],
            [
                'code' => 'SALE50K',
                'name' => 'Giảm 50,000 cho đơn từ 300,000',
                'type' => 'fixed',
                'value' => 50000,
                'max_discount' => null,
                'min_order_value' => 300000,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonth(),
                'usage_limit' => 300,
                'usage_count' => 0,
                'status' => 1,
            ],
            [
                'code' => 'FREESHIP',
                'name' => 'Miễn phí vận chuyển (tối đa 25k)',
                'type' => 'percent',
                'value' => 100,
                'max_discount' => 25000,
                'min_order_value' => 150000,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(2),
                'usage_limit' => 500,
                'usage_count' => 0,
                'status' => 1,
            ],
        ]);
    }
}
