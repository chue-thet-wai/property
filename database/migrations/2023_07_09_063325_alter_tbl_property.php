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
            $table->string('division',5)->nullable()->before('remark');
            $table->string('township',5)->nullable()->before('remark');
            $table->string('ward',5)->nullable()->before('remark');
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
