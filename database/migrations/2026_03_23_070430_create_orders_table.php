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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // user_id must be nullable for guests
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

            // Guest Details
            $table->string('guest_email')->nullable();
            $table->string('guest_name')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();

            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['pending', 'paid', 'shipped', 'delivered', 'cancelled'])->default('pending');

            // payment_method should be nullable if you don't set it immediately
            $table->string('payment_method')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
