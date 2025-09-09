<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("order_id")->constrained("orders")->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId("user_id")->constrained("users")->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId("resturant_id")->constrained("resturants")->onUpdate("cascade")->onDelete("cascade")->nullable();
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
        Schema::dropIfExists('carts');
    }
}
