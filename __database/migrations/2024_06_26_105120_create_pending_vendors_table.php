<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendingVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_vendors', function (Blueprint $table) {
            $table->id();
            $table->foreignId("added_by")->constrained("users")->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId("parent_id")->constrained("categories")->onUpdate("cascade")->onDelete("cascade")->nullable();
            $table->string('full_name');  //اسم التاجر أو اسم الرباعي للمندوب
            $table->string('owner_name')->nullable();
            $table->string('branches_no')->nullable();
            $table->string('national_id');
            $table->string('commercial_registration_no')->nullable();
            $table->string('driving_license_no')->nullable();
            $table->string('location')->nullable();
            $table->string('mobile');
            $table->string('another_mobile')->nullable();
            $table->string('vodafone_cash_mobile')->nullable();
            $table->enum('type',['vendor','delegate']);
            $table->enum('status',['pending','accepted','declined']);
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
        Schema::dropIfExists('pending_vendors');
    }
}
