<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->decimal('amount', 10, 2); // Adjust based on your needs
            $table->string('status');
            $table->timestamps(); // This will add created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
