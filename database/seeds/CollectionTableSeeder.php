<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('collections')->insert([
            'title' => 'Simple collection',
            'customer_id' => 1,
            'description' => 'Bed room design',
            'room_type' => '',
            'room_style' => '',
            'room_budget' => '',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
