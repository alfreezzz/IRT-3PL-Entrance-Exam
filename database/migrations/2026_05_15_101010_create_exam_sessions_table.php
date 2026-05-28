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
        Schema::create('exam_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->json('exam_ids');
            $table->foreignId('current_exam_id')->nullable()->constrained('exams')->nullOnDelete();
            $table->integer('current_index')->default(0);
            $table->string('status', 50)->default('pending');
            $table->dateTime('started_at')->nullable();
            $table->dateTime('current_started_at')->nullable();
            $table->dateTime('break_ends_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_sessions');
    }
};
