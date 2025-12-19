<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'name' => 'Consultation',
            'duration_minutes' => 30,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Service::create([
            'name' => 'Hair Cut',
            'duration_minutes' => 20,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Service::create([
            'name' => 'Hair Spa',
            'duration_minutes' => 60,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Service::create([
            'name' => 'Hair Wash',
            'duration_minutes' => 15,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
