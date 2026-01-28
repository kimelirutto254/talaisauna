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
        Schema::create('sauna_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->onDelete('cascade');
            $table->foreignId('sauna_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->nullable(); // assuming customers table might be seeded later or nullable
            $table->timestamp('start_time')->nullable();
            $table->timestamp('expected_end_time')->nullable();
            $table->timestamp('actual_end_time')->nullable();
            $table->enum('status', ['active', 'completed', 'cancelled'])->default('active');
            $table->foreignId('user_id')->constrained(); // created_by staff id
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sauna_sessions');
    }
};
