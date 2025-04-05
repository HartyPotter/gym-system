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
        Schema::create('profile_users', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('membership')->default('Free');
            $table->float('body_fats_percentage')->default(0);
            $table->float('muscle_mass_percentage')->default(0);
            $table->float('water_percentage')->default(0);
            $table->float('bone_mass_percentage')->default(0);
            $table->float('other_composition_percentage')->default(0);
            $table->float('cardio_percentage')->default(0);
            $table->float('daily_goal_percentage')->default(0);
            $table->float('calories_percentage')->default(0);
            $table->float('plan_progress_percentage')->default(0);
            $table->integer('videos_watched')->default(0);
            
            // إضافة الحقول للمفاتيح الخارجية
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_users');
    }
};
