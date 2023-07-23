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
        Schema::create('tbl_properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->string('title');
            $table->string('title_mm');
            $table->string('category',5);
            $table->string('status',5);
            $table->boolean('public_status')->default(0);
            $table->boolean('bank_loan')->default(0);
            $table->decimal('price',11,2);
            $table->decimal('promotion_price',11,2);
            $table->text('description')->nullable();
            $table->text('description_mm')->nullable();
            $table->string('property_location');
            $table->text('detail_address');
            $table->string('postal_code', 64);
            $table->string('google_map_url');
            $table->integer('front_area');
            $table->integer('side_area');
            $table->integer('square_feet');
            $table->float('acre');
            $table->unsignedBigInteger('tenure_property');
            $table->unsignedBigInteger('property_type')->nullable();
            $table->integer('floor')->nullable();
            $table->integer('master_bedroom')->nullable();
            $table->integer('common_room')->nullable();
            $table->integer('bathroom')->nullable();
            $table->year('build_year')->nullable();
            $table->text('building_facility')->nullable();
            $table->text('special_features')->nullable();
            $table->integer('view_count')->nullable();
            $table->string('feature_photo')->nullable();
            $table->text('remark')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            // $table->foreign('owner_id')->references('id')->on('tbl_owners');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_properties');
    }
};
