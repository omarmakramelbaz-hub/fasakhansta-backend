<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToResturantAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resturant_areas', function (Blueprint $table) {
            $table->string('lng')->nullable();
            $table->string('lat')->nullable();
            // We'll handle the area_id change in a separate migration if needed
            // $table->unsignedBigInteger('area_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resturant_areas', function (Blueprint $table) {
            $table->dropColumn(['lng', 'lat']);
            // The area_id change is reverted by dropping the entire migration
        });
    }
}
