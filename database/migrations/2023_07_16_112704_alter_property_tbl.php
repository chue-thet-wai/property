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
         Schema::table('tbl_properties', function (Blueprint $table) {
            $table->decimal('promotion_price',11,2)->nullable()->change();
            $table->text('google_map_url')->nullable()->change();
            $table->text('detail_address')->nullable()->change();
            $table->text('remark')->nullable()->change();
            $table->integer('master_bedroom')->nullable()->change();
            $table->integer('common_room')->nullable()->change();
            $table->integer('bathroom')->nullable()->change();
        });
        Schema::table('property_rents', function (Blueprint $table) {
            $table->decimal('promotion_price',11,2)->nullable()->change();
            $table->text('google_map_url')->nullable()->change();
            $table->text('detail_address')->nullable()->change();
            $table->text('remark')->nullable()->change();
            $table->integer('master_bedroom')->nullable()->change();
            $table->integer('common_room')->nullable()->change();
            $table->integer('bathroom')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
