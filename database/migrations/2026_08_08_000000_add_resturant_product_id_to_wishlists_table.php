<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wishlists', function (Blueprint $table) {
            $table->foreignId('resturant_product_id')
                ->nullable()
                ->after('resturant_id')
                ->constrained('resturant_products')
                ->cascadeOnDelete();

            $table->unique(['user_id', 'resturant_product_id'], 'wishlists_user_resturant_product_unique');
        });
    }

    public function down(): void
    {
        Schema::table('wishlists', function (Blueprint $table) {
            $table->dropUnique('wishlists_user_resturant_product_unique');
            $table->dropForeign(['resturant_product_id']);
            $table->dropColumn('resturant_product_id');
        });
    }
};
