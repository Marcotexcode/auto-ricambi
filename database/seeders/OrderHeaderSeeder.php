<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderHeader;


class OrderHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderHeader::factory()->count(5)->create();
    }
}
