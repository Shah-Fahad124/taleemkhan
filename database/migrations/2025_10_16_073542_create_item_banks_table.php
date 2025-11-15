<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('item_banks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->foreignId('grade_id')->constrained('grades')->onDelete('cascade');
            $table->string('slo')->nullable();
            $table->string('slo_no')->nullable();
            $table->string('skill')->nullable();
            $table->string('semester')->nullable();
            $table->string('month')->nullable();
            $table->string('difficulty')->nullable();
            $table->string('category')->nullable();
            $table->string('item_type'); // MCQ, RRQ, ERQ
            $table->text('item_description')->nullable();
            $table->text('stimulus')->nullable();

            // For MCQs
            $table->text('option_a')->nullable();
            $table->text('option_b')->nullable();
            $table->text('option_c')->nullable();
            $table->text('option_d')->nullable();
            $table->string('correct_answer')->nullable();

            // For RRQ / ERQ
            $table->text('possible_answers')->nullable();
            $table->text('marking_hints')->nullable();
            $table->text('rubric')->nullable();
            $table->integer('total_marks')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_banks');
    }
};
