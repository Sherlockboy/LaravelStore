<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    private const TABLE_NAME = 'payment_methods';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table(self::TABLE_NAME)->insert([
            'code' => 'cod',
            'title' => 'Cash on delivery'
        ]);

        DB::table(self::TABLE_NAME)->insert([
            'code' => 'ccod',
            'title' => 'Credit card on Delivery'
        ]);
    }
}
