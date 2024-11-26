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
        Schema::create('currency_exchanges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // The user performing the conversion
            $table->foreignId('from_payment_method_id')->constrained('payment_methods')->onDelete('cascade'); // Source payment method
            $table->foreignId('to_payment_method_id')->constrained('payment_methods')->onDelete('cascade'); // Target payment method
            $table->decimal('amount', 15, 2); // Amount to be converted
            $table->decimal('converted_amount', 15, 2); // Amount after conversion
            $table->decimal('exchange_rate', 10, 4); // Exchange rate used
            $table->decimal('fee', 10, 2); // Conversion fee applied
            $table->enum('fee_type', ['fixed', 'percentage'])->default('percentage'); // Fee type
            // status: 'pending', 'completed', 'failed'
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_exchange');
    }
};
