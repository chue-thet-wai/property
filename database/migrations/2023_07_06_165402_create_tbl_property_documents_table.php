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
        Schema::create('tbl_property_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('confidential_documents');
            $table->timestamps();
            $table->foreign('property_id')->references('id')->on('tbl_properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_property_documents');
    }
};
