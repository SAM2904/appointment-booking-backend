<?php

namespace Database\Seeders;

use App\Models\Weekday;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeekdaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $weekdays = [
            ['name' => 'Sunday', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Monday', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tuesday', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Wednesday', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Thursday', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Friday', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Saturday', 'created_at' => now(), 'updated_at' => now()],
        ];
        Weekday::insert($weekdays);
    }
}
