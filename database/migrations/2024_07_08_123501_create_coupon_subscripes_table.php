<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponSubscripesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_subscripes', function (Blueprint $table) {
            $table->id();
             $table->foreignId('user_id')
            ->constrained('users')
            ->onDelete('cascade');
            $table->string('user_coupon_code');
            $table->decimal('price',8,2);
            $table->decimal('amount',8,2);
            $table->enum('status',['loser','winner'])->nullable();
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
        Schema::dropIfExists('coupon_subscripes');
    }
}
