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
        Schema::create('main_agency_information', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo');
            $table->string('header')->nullable();
            $table->string('footer')->nullable();
            $table->string('watermark_txt')->nullable();
            $table->string('watermark_img')->nullable();
            $table->string('default_img')->nullable();
            $table->string('home_img')->nullable();
            $table->text('content')->nullable();
            $table->text('content_mm')->nullable();
            $table->text('about_us')->nullable();
            $table->text('about_us_mm')->nullable();
            $table->text('address')->nullable();
            $table->text('address_mm')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('viber')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('facebook')->nullable();
            $table->string('send_message')->nullable();
            $table->text('footer_info')->nullable();
            $table->string('developer_info')->nullable();
            $table->boolean('is_delete')->default(0);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('main_agency_information');
    }
};
