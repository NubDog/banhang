<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // First, let's make sure we have some product types
        $typeIds = DB::table('type_products')->pluck('id')->toArray();
        
        // If no product types exist, create some
        if (empty($typeIds)) {
            $typeIds[] = DB::table('type_products')->insertGetId([
                'name' => 'Bánh ngọt',
                'description' => 'Các loại bánh ngọt thơm ngon',
                'image' => 'banh-ngot.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            $typeIds[] = DB::table('type_products')->insertGetId([
                'name' => 'Bánh truyền thống',
                'description' => 'Các loại bánh truyền thống Việt Nam',
                'image' => 'banh-truyen-thong.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            $typeIds[] = DB::table('type_products')->insertGetId([
                'name' => 'Bánh kem',
                'description' => 'Các loại bánh kem đặc biệt',
                'image' => 'banh-kem.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        // Now add the products with the images you've uploaded
        $products = [
            [
                'name' => 'Bánh T-90',
                'id_type' => $typeIds[array_rand($typeIds)],
                'description' => 'Bánh T-90 đặc biệt với hình dáng độc đáo, hương vị thơm ngon và bổ dưỡng.',
                'unit_price' => 150000,
                'promotion_price' => 120000,
                'image' => 'T-90.png',
                'unit' => 'cái',
                'new' => 1,
                'is_promotion' => 0, // Will be randomly set later
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bánh Thuyền',
                'id_type' => $typeIds[array_rand($typeIds)],
                'description' => 'Bánh Thuyền với hình dáng như chiếc thuyền con, thơm ngon và đẹp mắt.',
                'unit_price' => 85000,
                'promotion_price' => 0,
                'image' => 'Hinh-anh-tau-con-thoi-dep-nhat.png',
                'unit' => 'cái',
                'new' => 1,
                'is_promotion' => 0, // Will be randomly set later
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bánh Chưng',
                'id_type' => $typeIds[array_rand($typeIds)],
                'description' => 'Bánh Chưng truyền thống, đậm đà hương vị Tết Việt Nam.',
                'unit_price' => 60000,
                'promotion_price' => 50000,
                'image' => 'anh-dep-ve-banh-chung_023617585.png',
                'unit' => 'cái',
                'new' => 0,
                'is_promotion' => 0, // Will be randomly set later
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bánh Hoa Quả',
                'id_type' => $typeIds[array_rand($typeIds)],
                'description' => 'Bánh Hoa Quả tươi ngon với nhiều loại trái cây tự nhiên.',
                'unit_price' => 200000,
                'promotion_price' => 180000,
                'image' => '6999296.png',
                'unit' => 'cái',
                'new' => 1,
                'is_promotion' => 0, // Will be randomly set later
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bánh Giga Chad',
                'id_type' => $typeIds[array_rand($typeIds)],
                'description' => 'Bánh Giga Chad đặc biệt, dành cho những người yêu thích sự mạnh mẽ và độc đáo.',
                'unit_price' => 250000,
                'promotion_price' => 0,
                'image' => 'smiling-giga-chad-2uzbwfl2i4sbu16m.png',
                'unit' => 'cái',
                'new' => 1,
                'is_promotion' => 0, // Will be randomly set later
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        
        // Insert products
        foreach ($products as $product) {
            DB::table('products')->insert($product);
        }
        
        // Now randomly set 4-6 products as promotional
        $productIds = DB::table('products')->pluck('id')->toArray();
        $numPromotional = rand(4, 6);
        $promotionalIds = array_rand(array_flip($productIds), min($numPromotional, count($productIds)));
        
        if (!is_array($promotionalIds)) {
            $promotionalIds = [$promotionalIds];
        }
        
        foreach ($promotionalIds as $id) {
            DB::table('products')->where('id', $id)->update(['is_promotion' => 1]);
        }
    }
}