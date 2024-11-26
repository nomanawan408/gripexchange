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
        Schema::table('users', function (Blueprint $table) {
            //
            // CNIC Verification
        $table->string('cnic_front')->nullable(); // Path to CNIC front image
        $table->string('cnic_back')->nullable(); // Path to CNIC back image
        $table->enum('cnic_status', ['pending', 'approved', 'rejected'])->default('pending');
        

        // Phone Verification
        $table->string('phone_verification_code')->nullable();
        $table->boolean('phone_verified')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn(['cnic_front', 'cnic_back', 'cnic_status', 'phone_verification_code', 'phone_verified']);
   
        });
    }
};
