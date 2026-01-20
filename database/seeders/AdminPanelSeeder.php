<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;

class AdminPanelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Categories
        $categories = [
            'Bakar',
            'Goreng',
            'Minuman',
            'Paket Hemat'
        ];

        foreach ($categories as $catName) {
            Category::firstOrCreate(
                ['slug' => Str::slug($catName)],
                ['name' => $catName]
            );
        }

        $bakarCat = Category::where('slug', 'bakar')->first();
        $gorengCat = Category::where('slug', 'goreng')->first();
        $minumanCat = Category::where('slug', 'minuman')->first();

        // 2. Update Random Menus or Create if empty
        if (Menu::count() == 0) {
            Menu::create([
                'name' => 'Ikan Bakar Jimbaran',
                'price' => 45000,
                'description' => 'Ikan segar dibakar dengan bumbu khas Jimbaran.',
                'status' => 'Tersedia',
                'category_id' => $bakarCat->id,
            ]);
        } else {
            // Assign random categories to existing menus where category_id is null
            Menu::whereNull('category_id')->get()->each(function ($menu) use ($bakarCat, $gorengCat, $minumanCat) {
                // Simple logic based on name or random
                if (stripos($menu->name, 'bakar') !== false) {
                    $menu->update(['category_id' => $bakarCat->id]);
                } elseif (stripos($menu->name, 'goreng') !== false) {
                    $menu->update(['category_id' => $gorengCat->id]);
                } else {
                    $menu->update(['category_id' => $minumanCat->id]);
                }
            });
        }

        // 3. Create Dummy Orders
        if (Order::count() == 0) {
            $menus = Menu::limit(3)->get();
            if ($menus->count() > 0) {
                // Order 1: Pending
                $order1 = Order::create([
                    'customer_name' => 'Ali',
                    'total_price' => 0, // Will calculate
                    'status' => 'pending',
                    'payment_status' => 'unpaid'
                ]);
                OrderItem::create([
                    'order_id' => $order1->id,
                    'menu_id' => $menus[0]->id,
                    'quantity' => 2,
                    'price' => $menus[0]->price
                ]);
                $order1->update(['total_price' => $menus[0]->price * 2]);

                // Order 2: Completed & Paid
                $order2 = Order::create([
                    'customer_name' => 'Budi',
                    'total_price' => 0,
                    'status' => 'completed',
                    'payment_status' => 'paid'
                ]);
                OrderItem::create([
                    'order_id' => $order2->id,
                    'menu_id' => $menus[0]->id,
                    'quantity' => 1,
                    'price' => $menus[0]->price
                ]);
                if (isset($menus[1])) {
                    OrderItem::create([
                        'order_id' => $order2->id,
                        'menu_id' => $menus[1]->id,
                        'quantity' => 1,
                        'price' => $menus[1]->price
                    ]);
                    $order2->update(['total_price' => $menus[0]->price + $menus[1]->price]);
                } else {
                    $order2->update(['total_price' => $menus[0]->price]);
                }
            }
        }
    }
}
