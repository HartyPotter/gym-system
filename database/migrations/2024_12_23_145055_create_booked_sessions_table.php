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
        Schema::create('booked_sessions', function (Blueprint $table) {
            $table->id();
            $table->enum('plan', ['Basic', 'Premium', 'Elite']);
            $table->string('session_title');
            $table->enum('session_time', [
                '6:00 AM - 9:00 AM',
                '12:00 PM - 3:00 PM',
                '6:00 PM - 9:00 PM'
            ]);            
            $table->date('session_date');
            $table->text('description')->nullable();
            $table->string('session_image')->default('images/default_session.jpg');
            $table->foreignId('create_user_id')->nullable()->constrained('users');
            $table->foreignId('update_user_id')->nullable()->constrained('users');
            $table->foreignId('trainer_id')->nullable()->constrained('trainers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booked_sessions');
    }
};
