<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_year_id')->constrained()->onDelete('cascade');
            $table->enum('grade', ['7', '8', '9']);
            $table->integer('male_count')->default(0);
            $table->integer('female_count')->default(0);
            $table->integer('total_classes')->default(0);
            $table->timestamps();
            
            $table->unique(['academic_year_id', 'grade']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_statistics');
    }
};
