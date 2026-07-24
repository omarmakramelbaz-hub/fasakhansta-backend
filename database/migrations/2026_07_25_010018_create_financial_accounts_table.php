<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_accounts', function (Blueprint $table) {
           $table->id();

$table->uuid('uuid')->unique();

$table->string('owner_type');
$table->unsignedBigInteger('owner_id');

$table->string('account_type', 50);

$table->char('currency', 3)->default('EGP');

$table->string('status', 20)->default('active');

$table->decimal('available_balance', 20, 8)->default(0);

$table->decimal('held_balance', 20, 8)->default(0);

$table->json('metadata')->nullable();

$table->timestamps();

$table->unique(['owner_type', 'owner_id']);

$table->index('account_type');

$table->index('status');

$table->index(['account_type', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financial_accounts');
    }
}
