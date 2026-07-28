<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MakeAreaIdNullableInResturantAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Using raw SQL to avoid DBAL dependency
        DB::statement('ALTER TABLE resturant_areas MODIFY area_id BIGINT UNSIGNED NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Using raw SQL to avoid DBAL dependency
        DB::statement('ALTER TABLE resturant_areas MODIFY area_id BIGINT UNSIGNED NOT NULL');
    }
}