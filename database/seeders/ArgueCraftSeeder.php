<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ArgueCraftSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin ArgueCraft',
                'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
            ]
        );

        $this->call([
            LearningModuleSeeder::class,
            SimulationTopicSeeder::class,
        ]);
    }
}
