<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('categories')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('categories')->insert($this->fakeData());
    }

    /**
     * @return array
     */
    public function fakeData(): array
    {
        $name = [
            'Áo khoác nam',
            'Áo sơ mi nam',
            'Áo khoác nữ',
            'Áo sơ mi nữ',
            'Quần Jeans nam',
            'Quần Jeans nữ',
            'Đầm/Váy',
            'Chân váy',
            'Hoodie và Áo nỉ',
            'Quần Dài/Quần Âu',
            'Giày Thể Thao/ Sneakers',
            'Giày Tây Lười',
            'Giày Oxfords',
            'Giày Buộc Dây',
            'Giày Đế Bằng',
            'Giày Cao Gót',
        ];

        return array_map(function($name) {
            return [
                'name'       => $name,
                'created_at' => now(),
            ];
        }, $name);
    }
}
