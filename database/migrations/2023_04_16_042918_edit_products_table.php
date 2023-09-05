<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'products',
            function (Blueprint $table) {
                $table->double('price')->default(0)->after('name');
                $table->tinyInteger('is_featured')->default(0)->after('price');
                $table->text('introduce')->after('is_featured');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'products',
            function (Blueprint $table) {
                $table->dropColumn('price');
                $table->dropColumn('is_featured');
                $table->dropColumn('introduce');
            }
        );
    }
};
