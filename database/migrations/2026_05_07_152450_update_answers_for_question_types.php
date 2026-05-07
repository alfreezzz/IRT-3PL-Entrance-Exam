<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->unsignedBigInteger('question_statement_id')
                ->nullable()
                ->after('question_id');
            $table->longText('answer_text')
                ->nullable()
                ->after('option_id');
            $table->boolean('is_true')
                ->nullable()
                ->after('answer_text');
        });

        if (Schema::getConnection()->getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE answers MODIFY option_id BIGINT UNSIGNED NULL');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('answers', 'question_statement_id')) {
            Schema::table('answers', function (Blueprint $table) {
                $table->dropColumn(['question_statement_id', 'answer_text', 'is_true']);
            });
        }

        if (Schema::getConnection()->getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE answers MODIFY option_id BIGINT UNSIGNED NOT NULL');
        }
    }
};
