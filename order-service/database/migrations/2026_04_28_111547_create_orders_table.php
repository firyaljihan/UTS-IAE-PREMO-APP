<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('idOrder')->unique()->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('app_id');
            $table->string('app_name');
            $table->integer('price');
            $table->integer('qty')->default(1);
            $table->integer('total_price');
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->text('qris_url')->nullable();
            $table->timestamp('expired_at')->nullable();
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
