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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->enum('membership' , ['Silver','Gold','Platinum']);
            $table->enum('plan', ['Basic', 'Premium', 'Elite']);
            $table->decimal('price', 8, 2);
            $table->enum('duration', ['day', 'month', 'year']);
            $table->string('features');
            $table->foreignId('create_user_id')->nullable()->constrained('users');
            $table->foreignId('update_user_id')->nullable()->constrained('users');
            $table->foreignId('booked_session_id')->nullable()->constrained('booked_sessions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
