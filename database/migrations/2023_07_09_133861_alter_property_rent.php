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
            $table->string('postal_code')->nullable()->change();            
            $table->integer('view_count')->nullable()->change();            
        });
        Schema::table('property_rents', function (Blueprint $table) {
            $table->string('postal_code')->nullable()->change(); 
            $table->integer('view_count')->nullable()->change();
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
