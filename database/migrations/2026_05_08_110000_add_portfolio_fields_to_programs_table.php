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
        Schema::table('programs', function (Blueprint $table) {
            $table->boolean('portfolio_required')->default(false)->after('is_active');
            $table->text('portfolio_description')->nullable()->after('portfolio_required');
            $table->decimal('portfolio_weight', 5, 2)->default(0)->after('portfolio_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn(['portfolio_required', 'portfolio_description', 'portfolio_weight']);
        });
    }
};
