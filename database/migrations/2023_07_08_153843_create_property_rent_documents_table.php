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
        Schema::create('property_rent_documents', function (Blueprint $table) {
             $table->id();
                $table->unsignedBigInteger('property_rent_id');
                $table->string('confidential_documents');
                $table->timestamps();
                $table->foreign('property_rent_id')->references('id')->on('property_rents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_rent_documents');
    }
};
