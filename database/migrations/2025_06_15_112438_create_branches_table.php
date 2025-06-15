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
        Schema::create('branches', function (Blueprint $table) {
            $table->id('branch_id');
            $table->string('name');
            $table->text('address');
            $table->date('date_opened');
            $table->boolean('status')->default(true);
            $table->decimal('rent_amount', 10, 2);
            $table->enum('rent_type', ['daily', 'weekly', 'monthly']);
            $table->foreignId('userid')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
