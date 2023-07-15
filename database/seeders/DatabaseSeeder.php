<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Order;
use App\Models\Product;
use App\Models\ShoppingCart;
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
        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'first_name' => 'user ',
                'last_name' => '' . $i,
                'email' => 'user' . $i . '@app.com',
                'password' => Hash::make('password')
            ]);
            $token = $user->createToken('my_token')->plainTextToken;
            echo "$token\n";
        }

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
            $price = rand(100, 500);
            $is_offered = rand(0, 1);

            $product = Product::create([
                'name' => 'product ' . $i,
                'description' => 'product ' . $i . ' description',
                'price' => $price,
                'offer_price' => ($is_offered) ? rand($price - 100, $price) : null,
                'vendor_id' => Vendor::inRandomOrder()->limit(1)->get(['id'])->first()->id,
            ]);
            $product->tags()->save(Tag::inRandomOrder()->limit(1)->get(['id'])->first());
        }

        for ($i = 0; $i < 10; $i++) {
            $shopping_cart = ShoppingCart::create([
                'name' => 'shopping cart' . $i,
                'user_id' => User::inRandomOrder()->limit(1)->get(['id'])->first()->id
            ]);

            Product::inRandomOrder()->limit(2)->get()->each(function ($product) use ($shopping_cart) {
                $shopping_cart->products()->save($product);
            });
        }

        // $order = Order::create([
        //     'vendor_id' => 1,
        //     'shopping_cart_id' => 1,
        // ]);
    }
}
