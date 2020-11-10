<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            ['name'=>'test customer 3', 'phone'=>'235325234', 'code'=>'tc34',],
            ['name'=>'test customer 4', 'phone'=>'235325324', 'code'=>'tc35',],
        ]);
    }
}
