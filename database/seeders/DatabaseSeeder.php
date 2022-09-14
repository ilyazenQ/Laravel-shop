<?php

namespace Database\Seeders;

use App\Domain\Cart\Actions\AddCartItem;
use App\Domain\Cart\Actions\InitializeCart;
use App\Domain\Category\Category;
use App\Domain\City\City;
use App\Domain\Coupon\Coupon;
use App\Domain\Customer\Customer;
use App\Domain\Product\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::factory(150)->create();
        $cities = City::factory(30)->create();
        $categories = Category::factory(100)->create();

        $city_ids = $cities->pluck('id');
        $cat_ids = $categories->pluck('id');

        $products->each(function ($product) use ($city_ids, $cat_ids) {
            $product->cities()->attach($city_ids->random(4));
            $product->categories()->attach($cat_ids->random(1));
        });
        Coupon::factory()->create();

        /** @var \App\Models\User $user */
        $user = User::factory()->create([
            'email' => 'admin@shop.com',
            'name' => 'Admin',
        ]);

        $customer = Customer::create([
            'name' => $user->name,
            'email' => $user->email,
            'user_id' => $user->id,
            'street' => 'Street',
            'number' => '101',
            'postal' => '2000',
            'city' => 'City',
            'country' => 'Belgium',
        ]);

        $cart = (new InitializeCart)($customer);

        (new AddCartItem)($cart, $products->random(1)[0], 1);
        (new AddCartItem)($cart, $products->random(1)[0], 1);
        (new AddCartItem)($cart, $products->random(1)[0], 1);
    }
}
