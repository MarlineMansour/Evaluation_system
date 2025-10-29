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
        Schema::create('evaluation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('restrict');
            $table->boolean('target_is_set');
            $table->float('kpis_score')->nullable();
            $table->float('competencies_score')->nullable();
            $table->decimal('total_score',5,2);
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
        Schema::dropIfExists('evaluation');
    }
};
