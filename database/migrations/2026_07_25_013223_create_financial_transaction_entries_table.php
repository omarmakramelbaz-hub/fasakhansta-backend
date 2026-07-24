<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialTransactionEntriesTable extends Migration
{
    public function up()
    {
        Schema::create('financial_transaction_entries', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('transaction_id');

            $table->unsignedBigInteger('financial_account_id');

            $table->string('entry_type', 10);

            $table->decimal('amount', 18, 4);

            $table->char('currency', 3)->default('EGP');

            $table->string('description')->nullable();

            $table->json('metadata')->nullable();

            $table->timestamps();

            $table->foreign('transaction_id')
                ->references('id')
                ->on('financial_transactions')
                ->onDelete('cascade');

            $table->foreign('financial_account_id')
                ->references('id')
                ->on('financial_accounts')
                ->onDelete('restrict');

            $table->index('transaction_id');
            $table->index('financial_account_id');
            $table->index('entry_type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('financial_transaction_entries');
    }
}
