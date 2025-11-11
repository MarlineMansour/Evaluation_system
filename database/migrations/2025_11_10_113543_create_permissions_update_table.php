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
        Schema::table('permissions', function (Blueprint $table) {
            $table->foreignId('created_by')->constrained('users')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('updated_by')->constrained('users')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('deleted_by')->constrained('users')->restrictOnUpdate()->restrictOnDelete();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
