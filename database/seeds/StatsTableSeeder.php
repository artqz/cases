<?php

use Illuminate\Database\Seeder;
use App\Stats;

class StatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stats::create(
            [
                'name' => 'users',
                'value' => 0,
            ]);
        Stats::create(
            [
                'name' => 'games',
                'value' => 0,
            ]);
        Stats::create(
            [
                'name' => 'items',
                'value' => 0,
            ]);
        Stats::create(
            [
                'name' => 'posts',
                'value' => 0,
            ]);
        Stats::create(
            [
                'name' => 'clicks',
                'value' => 0,
            ]);
    }
}
