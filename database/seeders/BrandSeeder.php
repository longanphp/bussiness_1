<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('brands')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('brands')->insert($this->fakeData());
    }

    /**
     * @return array
     */
    public function fakeData(): array
    {
        $name = [
            'Gucci',
            'Chanel',
            'Versace',
            'Prada',
            'Christian Dior',
            'Hermès',
            'MLB',
            'Charles & keith',
            'Adidas',
            'Lacoste',
            'Puma',
        ];

        return array_map(function($name) {
            return [
                'name'       => $name,
                'created_at' => now(),
            ];
        }, $name);
    }
}
