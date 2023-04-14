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
            $table->string('title');
            $table->string('category',5);
            $table->string('protype',5);
            $table->string('location');
            $table->decimal('price',11,2);
            $table->string('squarefeet');
            $table->text('address');
            $table->string('postalcode');
            $table->string('story');
            $table->integer('bedroom');
            $table->integer('bathroom');
            $table->text('description')->nullable();
            $table->string('feature')->nullable();
            $table->string('outinspace');
            $table->string('amenities');
            $table->date('availabledate');
            $table->text('accessories')->nullable();
            $table->text('decoration')->nullable();
            $table->string('proname');
            $table->float('area');
            $table->string('condition');
            $table->string('developer');
            $table->string('tenure');
            $table->integer('builtyear');
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
        Schema::dropIfExists('tbl_properties');
    }
};
