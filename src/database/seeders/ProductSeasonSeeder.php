<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            ['product_id' => 1, 'season_id' => 3],
            ['product_id' => 1, 'season_id' => 4],
            ['product_id' => 2, 'season_id' => 1],
            ['product_id' => 3, 'season_id' => 4],
            ['product_id' => 4, 'season_id' => 2],
            ['product_id' => 5, 'season_id' => 2],
            ['product_id' => 6, 'season_id' => 2],
            ['product_id' => 6, 'season_id' => 3],
            ['product_id' => 7, 'season_id' => 1],
            ['product_id' => 7, 'season_id' => 2],
            ['product_id' => 8, 'season_id' => 2],
            ['product_id' => 8, 'season_id' => 3],
            ['product_id' => 9, 'season_id' => 2],
            ['product_id' => 10, 'season_id' => 1],
            ['product_id' => 10, 'season_id' => 2],
        ];

        foreach($records as $record) {
            DB::table('product_season')->insert([
                'product_id' => $record['product_id'],
                'season_id' => $record['season_id'],
            ]);
        }
    }
}
