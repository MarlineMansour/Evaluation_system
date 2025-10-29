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
        Schema::create('positions', function (Blueprint $table) {

            $table->id();
            $table->string('name_en');
            $table->string('name_ar');
            $table->enum('type',['KPIs & Competencies', 'Competencies only', 'No KPIs & Competencies']);

            $table->boolean('is_active');
            // 0 ->false , 1 ->true
            $table->foreignId('department_id')->constrained()->onDelete('restrict');
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
        Schema::dropIfExists('position');
    }
};
