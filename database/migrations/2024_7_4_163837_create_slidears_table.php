<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slidears', function (Blueprint $table) {
            $table->id();
            $table->foreignId('added_by')
            ->constrained('users')
            ->onDelete('cascade');
              $table->foreignId('restraunt_id')
            ->constrained('resturants')
            ->onDelete('cascade');
            $table->string('title');
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
        Schema::dropIfExists('slidears');
    }
}
