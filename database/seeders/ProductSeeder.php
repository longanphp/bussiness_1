<?php

namespace Database\Seeders;

use App\Modules\Admin\Brand\Models\Brand;
use App\Modules\Admin\Category\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('products')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('products')->insert($this->fakeData());
    }

    /**
     * @return array
     */
    public function fakeData(): array
    {
        $name = [
            'Giày Nam phong cách trẻ trung',
            'Giày sneaker nam phong cách Hàn Quốc',
            'Giày thể thao cao cổ nam hot trend',
            'Giày Thể Thao Nam?Cổ Thấp Phong Cách Nhật Bản',
            'Giày nam phong cách mới nhất',
            'Áo Khoác Cardigan W Xanh Mặt Cười Ulzzang',
            'Áo Khoác Cardigan Viền Xanh Nâu FRMLK Form Rộng chew',
            'SET PIJAMA MẶC NHÀ 2 MÀU XANH',
            'quần ống rộng suông nữ lưng cao khóa trước 1 khuy vải tuyết mưa',
        ];

        $categories = Category::all()->pluck('id')->toArray();
        $brands = Brand::all()->pluck('id')->toArray();

        return array_map(
            function ($name) use ($categories, $brands) {
                return [
                    'name'        => $name,
                    'slug'        => generateSlug($name),
                    'introduce' => Str::random(225),
                    'description' => Str::random(225),
                    'category_id' => $categories[array_rand($categories)],
                    'brand_id'    => $brands[array_rand($brands)],
                    'status'      => INACTIVE,
                    'created_at'  => now(),
                ];
            },
            $name
        );
    }
}
