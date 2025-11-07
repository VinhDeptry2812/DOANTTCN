<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            VoucherSeeder::class,
        ]);

        DB::table('user')->insert([
            [
                'name' => 'Admin Vinh',
                'email' => 'vinhdz2812@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nguyen Van A',
                'email' => 'user1@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nguyen Van B',
                'email' => 'user2@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        // DB::table('blogs')->insert([
        //     [
        //         'user_id' => 3,
        //         'title' => 'The Personality Trait That Makes People Happier',
        //         'image' => 'blog-1.jpg',
        //         'category' => 'TRAVEL',
        //         'content' => '',
        //     ],
        //     [
        //         'user_id' => 3,
        //         'title' => 'This was one of our first days in Hawaii last week.',
        //         'image' => 'blog-2.jpg',
        //         'category' => 'CodeLeanON',
        //         'content' => '',
        //     ],
        //     [
        //         'user_id' => 3,
        //         'title' => 'Last week I had my first work trip of the year to Sonoma Valley',
        //         'image' => 'blog-3.jpg',
        //         'category' => 'TRAVEL',
        //         'content' => '',
        //     ],
        //     [
        //         'user_id' => 3,
        //         'title' => 'Happppppy New Year! I know I am a little late on this post',
        //         'image' => 'blog-4.jpg',
        //         'category' => 'CodeLeanON',
        //         'content' => '',
        //     ],
        //     [
        //         'user_id' => 3,
        //         'title' => 'Absolue collection. The Lancome team has been one…',
        //         'image' => 'blog-5.jpg',
        //         'category' => 'MODEL',
        //         'content' => '',
        //     ],
        //     [
        //         'user_id' => 3,
        //         'title' => 'Writing has always been kind of therapeutic for me',
        //         'image' => 'blog-6.jpg',
        //         'category' => 'CodeLeanON',
        //         'content' => '',
        //     ],
        // ]);

        // DB::table('brands')->insert([
        //     [
        //         'name' => 'Calvin Klein',
        //     ],
        //     [
        //         'name' => 'Diesel',
        //     ],
        //     [
        //         'name' => 'Polo',
        //     ],
        //     [
        //         'name' => 'Tommy Hilfiger',
        //     ],
        // ]);

        DB::table('categories')->insert([
            [
                'name' => 'Clothing',
                'decription' => 'All kinds of clothing for men and women.',
                'slug' => Str::slug('Clothing'),
                'image' => 'clothing.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Accessories',
                'decription' => 'Bags, hats, belts, and other accessories.',
                'slug' => Str::slug('Accessories'),
                'image' => 'accessories.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Shoes',
                'decription' => 'Footwear collection for men and women.',
                'slug' => Str::slug('Shoes'),
                'image' => 'shoes.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Handbags',
                'decription' => 'Various types of handbags.',
                'slug' => Str::slug('Handbags'),
                'image' => 'handbags.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Electronics',
                'decription' => 'Gadgets and electronic items.',
                'slug' => Str::slug('Electronics'),
                'image' => 'electronics.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('products')->insert([
            [
                'id' => 1,
                'category_id' => 2,
                'name' => 'Pure Pineapple',
                'slug' => Str::slug('Pure Pineapple'),
                'decription' => 'Lorem ipsum dolor sit amet, consectetur ing elit, sed do eiusmod tempor sum dolor sit amet, consectetur adipisicing elit, sed do mod tempor',
                'price' => 629.99,
                'discout_price' => 495,
                'stock' => 20,
                'sku' => '00012',
                'image' => null,
                'gallery' => null,
                'status' => true,
            ],
            [
                'id' => 2,
                'category_id' => 2,
                'name' => 'Guangzhou sweater',
                'slug' => Str::slug('Guangzhou sweater'),
                'decription' => null,
                'price' => 35,
                'discout_price' => 13,
                'stock' => 20,
                'sku' => null,
                'image' => null,
                'gallery' => null,
                'status' => true,
            ],
            [
                'id' => 3,
                'category_id' => 2,
                'name' => 'Guangzhou sweater',
                'slug' => Str::slug('Guangzhou sweater 2'),
                'decription' => null,
                'price' => 35,
                'discout_price' => 34,
                'stock' => 20,
                'sku' => null,
                'image' => null,
                'gallery' => null,
                'status' => true,
            ],
            [
                'id' => 4,
                'category_id' => 1,
                'name' => 'Microfiber Wool Scarf',
                'slug' => Str::slug('Microfiber Wool Scarf'),
                'decription' => null,
                'price' => 64,
                'discout_price' => 35,
                'stock' => 20,
                'sku' => null,
                'image' => null,
                'gallery' => null,
                'status' => true,
            ],
            [
                'id' => 5,
                'category_id' => 3,
                'name' => "Men's Painted Hat",
                'slug' => Str::slug("Men's Painted Hat"),
                'decription' => null,
                'price' => 44,
                'discout_price' => 35,
                'stock' => 20,
                'sku' => null,
                'image' => null,
                'gallery' => null,
                'status' => false,
            ],
            [
                'id' => 6,
                'category_id' => 2,
                'name' => 'Converse Shoes',
                'slug' => Str::slug('Converse Shoes'),
                'decription' => null,
                'price' => 35,
                'discout_price' => 34,
                'stock' => 20,
                'sku' => null,
                'image' => null,
                'gallery' => null,
                'status' => true,
            ],
            [
                'id' => 7,
                'category_id' => 1,
                'name' => 'Pure Pineapple Bag',
                'slug' => Str::slug('Pure Pineapple Bag'),
                'decription' => null,
                'price' => 64,
                'discout_price' => 35,
                'stock' => 20,
                'sku' => null,
                'image' => null,
                'gallery' => null,
                'status' => true,
            ],
            [
                'id' => 8,
                'category_id' => 1,
                'name' => '2 Layer Windbreaker',
                'slug' => Str::slug('2 Layer Windbreaker'),
                'decription' => null,
                'price' => 44,
                'discout_price' => 35,
                'stock' => 20,
                'sku' => null,
                'image' => null,
                'gallery' => null,
                'status' => true,
            ],
            [
                'id' => 9,
                'category_id' => 1,
                'name' => 'Converse Shoes 2',
                'slug' => Str::slug('Converse Shoes 2'),
                'decription' => null,
                'price' => 35,
                'discout_price' => 34,
                'stock' => 20,
                'sku' => null,
                'image' => null,
                'gallery' => null,
                'status' => true,
            ],
        ]);


        // DB::table('product_images')->insert([
        //     [
        //         'product_id' => 1,
        //         'path' => 'product-1.jpg',
        //     ],
        //     [
        //         'product_id' => 1,
        //         'path' => 'product-1-1.jpg',
        //     ],
        //     [
        //         'product_id' => 1,
        //         'path' => 'product-1-2.jpg',
        //     ],
        //     [
        //         'product_id' => 2,
        //         'path' => 'product-2.jpg',
        //     ],
        //     [
        //         'product_id' => 3,
        //         'path' => 'product-3.jpg',
        //     ],
        //     [
        //         'product_id' => 4,
        //         'path' => 'product-4.jpg',
        //     ],
        //     [
        //         'product_id' => 5,
        //         'path' => 'product-5.jpg',
        //     ],
        //     [
        //         'product_id' => 6,
        //         'path' => 'product-6.jpg',
        //     ],
        //     [
        //         'product_id' => 7,
        //         'path' => 'product-7.jpg',
        //     ],
        //     [
        //         'product_id' => 8,
        //         'path' => 'product-8.jpg',
        //     ],
        //     [
        //         'product_id' => 9,
        //         'path' => 'product-9.jpg',
        //     ],
        // ]);

        // DB::table('product_details')->insert([
        //     [
        //         'product_id' => 1,
        //         'color' => 'blue',
        //         'size' => 'S',
        //         'qty' => 5,
        //     ],
        //     [
        //         'product_id' => 1,
        //         'color' => 'blue',
        //         'size' => 'M',
        //         'qty' => 5,
        //     ],
        //     [
        //         'product_id' => 1,
        //         'color' => 'blue',
        //         'size' => 'L',
        //         'qty' => 5,
        //     ],
        //     [
        //         'product_id' => 1,
        //         'color' => 'blue',
        //         'size' => 'XS',
        //         'qty' => 5,
        //     ],
        //     [
        //         'product_id' => 1,
        //         'color' => 'yellow',
        //         'size' => 'S',
        //         'qty' => 0,
        //     ],
        //     [
        //         'product_id' => 1,
        //         'color' => 'violet',
        //         'size' => 'S',
        //         'qty' => 0,
        //     ],
        // ]);

        // DB::table('product_comments')->insert([
        //     [
        //         'product_id' => 1,
        //         'user_id' => 4,
        //         'email' => 'BrandonKelley@gmail.com',
        //         'name' => 'Brandon Kelley',
        //         'messages' => 'Nice !',
        //         'rating' => 4,
        //     ],
        //     [
        //         'product_id' => 1,
        //         'user_id' => 5,
        //         'email' => 'RoyBanks@gmail.com',
        //         'name' => 'Roy Banks',
        //         'messages' => 'Nice !',
        //         'rating' => 4,
        //     ],
        // ]);
    }
}
