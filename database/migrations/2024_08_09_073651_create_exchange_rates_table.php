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
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_method_id')->constrained('payment_methods')->onDelete('cascade'); // Foreign key to payment methods
            $table->decimal('buy', 10, 4)->nullable(); // Buy rate
            $table->decimal('sell', 10, 4)->nullable(); // Sell rate
            $table->decimal('deposit_fee', 10, 4)->nullable(); // Deposit fee
            $table->decimal('withdraw_fee', 10, 4)->nullable(); // Withdraw fee
            $table->enum('deposit_fee_type', ['fixed', 'percentage'])->nullable();
            $table->enum('withdraw_fee_type', ['fixed', 'percentage'])->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_rates');
    }
};
