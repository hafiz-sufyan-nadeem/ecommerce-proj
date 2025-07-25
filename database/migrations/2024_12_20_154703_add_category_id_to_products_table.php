<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasColumn('products', 'category_id')) {
            Schema::table('products', function (Blueprint $table) {
                $table->unsignedBigInteger('category_id')->nullable()->after('price');
            });
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if (Schema::hasColumn('products', 'category_id')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('category_id');
            });
        }
    }

};
