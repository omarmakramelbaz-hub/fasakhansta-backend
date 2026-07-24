<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->uuid('uuid')->unique();

            $table->string('type', 50);

            $table->string('status', 30);

            $table->string('reference_type')->nullable();

            $table->unsignedBigInteger('reference_id')->nullable();

            $table->string('idempotency_key')->nullable()->unique();

            $table->string('description')->nullable();

            $table->json('metadata')->nullable();

            $table->timestamp('completed_at')->nullable();

            $table->timestamps();

            $table->index(['reference_type', 'reference_id']);
            $table->index('type');
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('financial_transactions');
    }
}
