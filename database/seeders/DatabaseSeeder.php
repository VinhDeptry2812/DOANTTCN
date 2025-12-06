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

        

        DB::table('user')->insert([
            [
                'name' => 'Admin Vinh',
                'email' => 'vinhdz2812@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
                'phone_number' => '',
                'dia_chi' => '',
            ],
            [
                'name' => 'Thanh Óc Cứt',
                'email' => 'khachhang@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
                'phone_number' => '999999999',
                'dia_chi' => 'Dưới tầng hầm',
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



        // Danh mục
        // DB::table('categories')->insert([
        //     [
        //         'name' => 'Nam',
        //         'decription' => 'Tất cả các loại áo quần cho nam.',
        //         'slug' => Str::slug('Áo nam'),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'name' => 'Nữ',
        //         'decription' => 'Tất cả các loại áo quần cho nữ',
        //         'slug' => Str::slug('Áo nữ'),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'name' => 'Trẻ em',
        //         'decription' => 'Bộ sưu tập giày dép cho nam và nữ.',
        //         'slug' => Str::slug('Trẻ em'),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ]);

        // Sản phẩm
        // DB::table('products')->insert([
        //     ['category_id' => 1, 'name' => 'Áo thun nam', 'slug' => Str::slug('Áo thun nam'), 'decription' => 'Áo thun cotton mềm mại, thoáng mát', 'price' => 199000, 'discount_price' => 149000, 'stock' => 50, 'sku' => 'ATN001', 'status' => true, 'created_at' => now(), 'updated_at' => now()],
        //     ['category_id' => 1, 'name' => 'Áo sơ mi nữ', 'slug' => Str::slug('Áo sơ mi nữ'), 'decription' => 'Áo sơ mi công sở nữ, kiểu dáng thanh lịch', 'price' => 249000, 'discount_price' => 199000, 'stock' => 30, 'sku' => 'ASN001', 'status' => true, 'created_at' => now(), 'updated_at' => now()],
        //     ['category_id' => 1, 'name' => 'Quần jean nam', 'slug' => Str::slug('Quần jean nam'), 'decription' => 'Quần jean nam thời trang, co giãn nhẹ', 'price' => 299000, 'discount_price' => 259000, 'stock' => 40, 'sku' => 'QJN001', 'status' => true, 'created_at' => now(), 'updated_at' => now()],
        //     ['category_id' => 1, 'name' => 'Quần kaki nữ', 'slug' => Str::slug('Quần kaki nữ'), 'decription' => 'Quần kaki nữ, nhiều màu lựa chọn', 'price' => 279000, 'discount_price' => 229000, 'stock' => 25, 'sku' => 'QKN001', 'status' => true, 'created_at' => now(), 'updated_at' => now()],
        //     ['category_id' => 2, 'name' => 'Mũ lưỡi trai', 'slug' => Str::slug('Mũ lưỡi trai'), 'decription' => 'Mũ lưỡi trai nam/nữ, chất liệu cotton', 'price' => 99000, 'discount_price' => 79000, 'stock' => 60, 'sku' => 'MLT001', 'status' => true, 'created_at' => now(), 'updated_at' => now()],
        //     ['category_id' => 2, 'name' => 'Thắt lưng da', 'slug' => Str::slug('Thắt lưng da'), 'decription' => 'Thắt lưng da thật, bền bỉ', 'price' => 159000, 'discount_price' => 129000, 'stock' => 40, 'sku' => 'TLD001', 'status' => true, 'created_at' => now(), 'updated_at' => now()],
        //     ['category_id' => 2, 'name' => 'Vòng tay thời trang', 'slug' => Str::slug('Vòng tay thời trang'), 'decription' => 'Vòng tay phong cách trẻ trung', 'price' => 79000, 'discount_price' => 59000, 'stock' => 80, 'sku' => 'VT001', 'status' => true, 'created_at' => now(), 'updated_at' => now()],
        //     ['category_id' => 3, 'name' => 'Giày thể thao nam', 'slug' => Str::slug('Giày thể thao nam'), 'decription' => 'Giày thể thao êm, chống trơn trượt', 'price' => 499000, 'discount_price' => 399000, 'stock' => 30, 'sku' => 'GTN001', 'status' => true, 'created_at' => now(), 'updated_at' => now()],
        //     ['category_id' => 3, 'name' => 'Giày cao gót nữ', 'slug' => Str::slug('Giày cao gót nữ'), 'decription' => 'Giày cao gót nữ, sang trọng', 'price' => 599000, 'discount_price' => 499000, 'stock' => 20, 'sku' => 'GGN001', 'status' => true, 'created_at' => now(), 'updated_at' => now()],
        // ]);


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
