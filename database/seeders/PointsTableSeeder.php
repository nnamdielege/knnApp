<?php

namespace Database\Seeders;

use App\Models\Point;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Point::insert([
            ['x' => 2.5, 'y' => 2.4, 'class' => 'A'],
            ['x' => 1.0, 'y' => 1.5, 'class' => 'B'],
            ['x' => 3.5, 'y' => 3.4, 'class' => 'A'],
            ['x' => 4.0, 'y' => 4.5, 'class' => 'B'],
            ['x' => 3.0, 'y' => 2.0, 'class' => 'A'],
            ['x' => 1.5, 'y' => 3.5, 'class' => 'C'],
            ['x' => 3.7, 'y' => 1.2, 'class' => 'C'],
            ['x' => 4.2, 'y' => 3.6, 'class' => 'D'],
            ['x' => 1.8, 'y' => 4.0, 'class' => 'E'],
            // Add more points as needed
        ]);
    }
}
