<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('coupon_wheels', function (Blueprint $table) {
            $table->decimal('prize_amount', 10, 2)->nullable()->after('price');
        });
    }

    public function down()
    {
        Schema::table('coupon_wheels', function (Blueprint $table) {
            $table->dropColumn('prize_amount');
        });
    }
};
