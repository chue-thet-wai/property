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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('first_name')->after('id');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('phone_no')->unique()->after('last_name');
            $table->longText('about')->nullable()->after('phone_no');
            $table->string('address')->nullable()->after('about');
            $table->string('profile_photo')->nullable()->after('address');
            $table->string('document')->nullable()->after('profile_photo');
            $table->boolean('status')->default(true)->after('document');
            $table->date('start_working_date')->nullable()->after('status');
            $table->date('resignation_date')->nullable()->after('start_working_date');
            $table->string('remark')->nullable()->after('resignation_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('phone_no');
            $table->dropColumn('about');
            $table->dropColumn('address');
            $table->dropColumn('profile_photo');
            $table->dropColumn('document');
            $table->dropColumn('status');
            $table->dropColumn('start_working_date');
            $table->dropColumn('resignation_date');
            $table->dropColumn('remark');
        });
    }
};
