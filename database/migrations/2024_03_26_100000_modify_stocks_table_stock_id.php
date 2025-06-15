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
        Schema::table('stocks', function (Blueprint $table) {
            // First drop the primary key
            $table->dropPrimary('stocks_stock_id_primary');
        });

        Schema::table('stocks', function (Blueprint $table) {
            // Drop the existing stock_id column
            $table->dropColumn('stock_id');
        });

        Schema::table('stocks', function (Blueprint $table) {
            // Add the new auto-incrementing stock_id column
            $table->bigIncrements('stock_id')->first();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            // Drop the auto-incrementing stock_id
            $table->dropColumn('stock_id');
        });

        Schema::table('stocks', function (Blueprint $table) {
            // Restore the original string stock_id
            $table->string('stock_id')->primary()->first();
        });
    }
}; 