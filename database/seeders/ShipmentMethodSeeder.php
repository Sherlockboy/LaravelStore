<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShipmentMethodSeeder extends Seeder
{
    private const TABLE_NAME = 'shipment_methods';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table(self::TABLE_NAME)->insert([
            'code' => 'fast',
            'title' => 'Fast Shipment',
            'description' => 'Fast but expensive'
        ]);

        DB::table(self::TABLE_NAME)->insert([
            'code' => 'slow',
            'title' => 'Slow shipment',
            'description' => 'Slow but cheap'
        ]);
    }
}
