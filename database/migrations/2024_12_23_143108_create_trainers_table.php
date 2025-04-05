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
        Schema::create('trainers', function (Blueprint $table) {
            $table->id();
            $table->string('specialization');
            $table->text('bio');
            $table->string('profile_picture')->nullable();
            $table->decimal('rating', 2, 1)->default(0);
            $table->integer('followers_count')->default(0);
            $table->integer('classes_count')->default(0);
            $table->integer('private_classes_count')->default(0);
            $table->integer('group_classes_count')->default(0);
            $table->text('certifications')->nullable();
            $table->foreignId('create_user_id')->nullable()->constrained('users');
            $table->foreignId('update_user_id')->nullable()->constrained('users');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainers');
    }
};
