<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PesananSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Pesanan::create([
            'id' => '1',
            'user_id' => '11',
            'product_id' => '1',
            'order_amount' => '2',
            'order_ship_address' => 'Jl. Ciganitri Tengah RT.04 RW. 02',
            'customer_phone_number' => '085156462582',
            'order_tracking_number' => 'OTN-2021-08-02-1-11-1',
            'order_status' => 'Dikonfirmasi',
        ]);
    }
}
