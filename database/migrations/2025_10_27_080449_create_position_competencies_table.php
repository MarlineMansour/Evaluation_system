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
        Schema::create('position_competencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('position_id')->constrained()->onDelete('restrict');
            $table->foreignId('competency_id')->constrained()->onDelete('restrict');
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
        Schema::dropIfExists('position_competencies');
    }
};
