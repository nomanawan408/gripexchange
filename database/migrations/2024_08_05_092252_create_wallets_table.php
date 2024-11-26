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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('balance', 55, 2)->default(0.00); // Initial balance
            $table->string('currency')->default('PKR'); // Default currency
            $table->decimal('daily_profit',50, 2)->default(0.00); // Daily profit 
            $table->decimal('referal_profit', 50, 2)->default(0.00); // Referral profit
            $table->decimal('total_profit', 50, 2)->default(0.00); // Total profit
            $table->string('pin')->nullable();
            $table->timestamps();
        });    
    }
            
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
