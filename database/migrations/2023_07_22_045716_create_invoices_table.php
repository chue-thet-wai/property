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
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_id')->unique();
            $table->string('type',2)->nullable();
            $table->date('contract_date')->nullable();
            $table->date('rentout_date')->nullable();
            $table->integer('contract_month')->nullable();
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('partner_id');
            $table->text('description')->nullable();
            $table->decimal('deal_price',11,2)->nullable();
            $table->decimal('agent_fee',11,2)->default(0);
            $table->decimal('discount',11,2)->default(0);
            $table->decimal('tax',11,2)->default(0);
            $table->decimal('total',11,2)->default(0);
            $table->decimal('partner_fee',11,2)->default(0);
            $table->decimal('agency_net_amt',11,2)->default(0);
            $table->string('contract_doc')->nullable();
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
        Schema::dropIfExists('invoices');
    }
};
