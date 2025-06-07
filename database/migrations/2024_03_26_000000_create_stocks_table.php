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
        Schema::create('stocks', function (Blueprint $table) {
            $table->string('stock_id')->primary();
            $table->string('stock_name');
            $table->boolean('stock_status')->default(1);
            $table->enum('stock_type', ['ingredients', 'machine', 'tools']);
            $table->foreignId('userid')->constrained('users');
            $table->timestamp('date_created')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
}; 