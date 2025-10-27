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
        Schema::create('employee_position_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->foreignId('position_id')->constrained();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->float('duration')->nullable();
            $table->foreignId('created_by')->constrained()->nullOnDelete();
            $table->foreignId('updated_by')->constrained()->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained()->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_position_history');
    }
};
