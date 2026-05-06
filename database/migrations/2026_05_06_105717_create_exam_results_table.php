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
        Schema::create('exam_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participant_id')->constrained()->cascadeOnDelete();
            $table->integer('total_correct')->default(0);
            $table->decimal('score_classical', 8, 2)->default(0);
            $table->decimal('score_irt', 10, 5)->default(0);
            $table->decimal('score_classical_weighted', 10, 5)->default(0);
            $table->decimal('score_irt_weighted', 10, 5)->default(0);
            $table->decimal('final_score', 10, 5)->default(0);
            $table->json('scoring_breakdown')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_results');
    }
};
