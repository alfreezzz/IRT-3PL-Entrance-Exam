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
        Schema::table('program_participant', function (Blueprint $table) {
            $table->string('portfolio_path')->nullable()->after('choice_order');
            $table->timestamp('portfolio_uploaded_at')->nullable()->after('portfolio_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('program_participant', function (Blueprint $table) {
            $table->dropColumn(['portfolio_path', 'portfolio_uploaded_at']);
        });
    }
};
