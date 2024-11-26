<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('account_statements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_method_id')->nullable()->constrained('payment_methods')->onDelete('cascade');
            $table->foreignId('deposit_id')->nullable()->constrained('deposits')->onDelete('cascade');
            $table->foreignId('withdraw_id')->nullable()->constrained('withdraws')->onDelete('cascade');            
            $table->foreignId('internal_transfer_id')->nullable()->constrained('internal_transfers')->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->string('currency')->default('pkr'); // Add currency field
            // $table->string('customer_account_name');
            // $table->string('customer_account_number');
            $table->string('customer_transaction_id')->nullable();
            $table->string('receipt_path')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_statements');
    }
};
