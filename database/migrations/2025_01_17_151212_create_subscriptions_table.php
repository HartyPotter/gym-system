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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->string('subscription_type'); // نوع الاشتراك
            $table->integer('duration'); // المدة بالأيام
            $table->decimal('total', 8, 2); // المبلغ
            $table->enum('payment_status', ['unpaid', 'paid', 'failed'])->default('unpaid'); // حالة الدفع
            $table->string('transaction_id')->nullable(); // معرّف المعاملة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
