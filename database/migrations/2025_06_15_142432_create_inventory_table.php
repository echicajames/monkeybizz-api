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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id('inventory_id');
            $table->foreignId('branch_id')->constrained('branches', 'branch_id');
            $table->foreignId('stock_id')->constrained('stocks', 'stock_id');
            $table->foreignId('userid')->constrained('users');
            $table->integer('quantity');
            $table->enum('type', ['stock_in', 'stock_out']);
            $table->text('reason')->nullable();
            $table->boolean('status')->default(true);
            $table->string('tag')->nullable();
            $table->timestamp('date_created')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
