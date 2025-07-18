<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeasonSeeder extends Seeder
{
    public function run()
    {
        $seasons = [
            "春",
            "夏",
            "秋",
            "冬"
        ];

        foreach($seasons as $name) {
            DB::table('seasons')->insert([
                'name' => $name,
            ]);
        }
    }
}
