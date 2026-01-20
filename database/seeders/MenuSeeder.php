<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Menu::create([
            'name' => 'Ikan Bakar Jimbaran',
            'price' => 35000,
            'description' => 'Ikan segar dengan bumbu khas Bali dan sambal matah.',
            'image' => 'https://images.unsplash.com/photo-1553621042-f6e147245754'
        ]);

        \App\Models\Menu::create([
            'name' => 'Ikan Bakar Padang',
            'price' => 32000,
            'description' => 'Pedas gurih dengan racikan rempah Padang.',
            'image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836'
        ]);

        \App\Models\Menu::create([
            'name' => 'Ikan Bakar Manado',
            'price' => 34000,
            'description' => 'Rica-rica pedas segar khas Manado.',
            'image' => 'https://images.unsplash.com/photo-1529692236671-f1f6cf9683ba'
        ]);
    }
}
