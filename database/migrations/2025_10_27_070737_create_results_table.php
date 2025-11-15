<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            // Link to generated_papers table (paper that was generated & used)
            $table->foreignId('paper_id')->constrained('generated_papers')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('school_id')->constrained('schools')->onDelete('cascade');
            $table->json('marks'); // JSON: { "question_id": obtained_mark, ... }
            $table->integer('total_obtained')->default(0);
            $table->integer('total_marks')->default(0);
            $table->string('remarks')->nullable();
            $table->timestamps();

            $table->unique(['paper_id', 'student_id']); // each student per paper only once
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
