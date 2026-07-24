<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId("added_by")->constrained("users")->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId("category_id")->constrained("categories")->onUpdate("cascade")->onDelete("cascade")->nullable();
            $table->foreignId("subcategory_id")->constrained("categories")->onUpdate("cascade")->onDelete("cascade")->nullable();
            $table->string('name_ar');
            // $table->json('prices');
            // $table->text('description');
            $table->enum('status',['show','hide']);
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
        Schema::dropIfExists('products');
    }
}
