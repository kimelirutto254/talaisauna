<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $nairobi = Branch::create(['name' => 'Nairobi Branch', 'location' => 'Nairobi']);
        $kapsabet = Branch::create(['name' => 'Kapsabet Branch', 'location' => 'Kapsabet']);

        // Seeding Saunas
        $s1 = \App\Models\Sauna::create([
            'branch_id' => $nairobi->id,
            'name' => 'General Steam Room 1',
            'type' => 'steam',
            'capacity' => 10,
            'price' => 1500, // per person usually
            'session_duration' => 60
        ]);
        \App\Models\PricingRule::create(['sauna_id' => $s1->id, 'price_type' => 'flat', 'price' => 1500]);
        \App\Models\PricingRule::create(['sauna_id' => $s1->id, 'price_type' => 'per_hour', 'price' => 1500]);
        
        $s2 = \App\Models\Sauna::create([
            'branch_id' => $nairobi->id,
            'name' => 'VIP Sauna (Dry)',
            'type' => 'dry',
            'capacity' => 2,
            'price' => 3000, 
            'session_duration' => 45
        ]);
        \App\Models\PricingRule::create(['sauna_id' => $s2->id, 'price_type' => 'flat', 'price' => 3000]);

        $s3 = \App\Models\Sauna::create([
            'branch_id' => $kapsabet->id,
            'name' => 'Main Steam Room',
            'type' => 'steam',
            'capacity' => 8,
            'price' => 1000,
            'session_duration' => 60
        ]);
        \App\Models\PricingRule::create(['sauna_id' => $s3->id, 'price_type' => 'flat', 'price' => 1000]);
        \App\Models\PricingRule::create(['sauna_id' => $s3->id, 'price_type' => 'per_hour', 'price' => 1000]);

        // Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@sauna.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Nairobi Manager
        User::create([
            'name' => 'Nairobi Manager',
            'email' => 'nairobi@sauna.com',
            'password' => bcrypt('password'),
            'role' => 'manager',
            'branch_id' => $nairobi->id,
        ]);

        // Kapsabet Manager
        User::create([
            'name' => 'Kapsabet Manager',
            'email' => 'kapsabet@sauna.com',
            'password' => bcrypt('password'),
            'role' => 'manager',
            'branch_id' => $kapsabet->id,
        ]);
    }
}
