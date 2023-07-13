<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Order;
use App\Models\Product;
use App\Models\ShoppingList;
use App\Models\Tag;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [];
        for ($i = 1; $i <= 10; $i++) {
            array_push(
                $users,
                User::create([
                    'first_name' => 'user ',
                    'last_name' => '' . $i,
                    'email' => 'user' . $i . '@app.com',
                    'password' => Hash::make('password')
                ])
            );
        }

        $token = $users[0]->createToken('my_token')->plainTextToken;
        echo "$token\n";

        for ($i = 1; $i <= 3; $i++) {
            Vendor::create([
                'name' => 'vendor ' . $i,
                'description' => 'vendor 1 description',
                'user_id' => $i,
            ]);
        }

        for ($i = 1; $i <= 3; $i++) {
            $tag = Tag::create(['name' => 'tag ' . $i]);
            $tag->save();
        }

        for ($i = 0; $i < 10; $i++) {
            $product = Product::create([
                'name' => 'product ' . $i,
                'description' => 'product ' . $i . ' description',
                'price' => rand(100, 500),
                'vendor_id' => 1,
            ]);
            $product->tags()->save(Tag::inRandomOrder()->limit(1)->get(['id'])->first());
        }

        $shopping_list = ShoppingList::create([
            'name' => 'shopping list test',
            'user_id' => 1
        ]);

        $products = Product::inRandomOrder(4)->get();

        for ($i = 0; $i < 4; $i++) {
            $shopping_list->products()->save($products[$i]);
        }

        $order = Order::create([
            'vendor_id' => 1,
            'shopping_list_id' => 1,
        ]);
    }
}
