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
        Schema::table('item_parameters', function (Blueprint $table) {
            $table->foreignId('question_statement_id')
                ->nullable()
                ->after('question_id')
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('item_parameters', 'question_statement_id')) {
            Schema::table('item_parameters', function (Blueprint $table) {
                $table->dropForeign(['question_statement_id']);
                $table->dropColumn('question_statement_id');
            });
        }
    }
};
