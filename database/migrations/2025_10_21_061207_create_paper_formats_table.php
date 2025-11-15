<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('paper_formats', function (Blueprint $table) {
            $table->id();
            $table->integer('school_id');
            $table->enum('paper_type', ['formative', 'semester']);
            $table->unsignedInteger('version')->default(1);

            // MCQ counts
            $table->integer('mcq_easy')->default(0);
            $table->integer('mcq_medium')->default(0);
            $table->integer('mcq_hard')->default(0);

            // Fill in the blanks
            $table->integer('fib_easy')->default(0);
            $table->integer('fib_medium')->default(0);
            $table->integer('fib_hard')->default(0);

            // RRQ
            $table->integer('rrq_easy')->default(0);
            $table->integer('rrq_medium')->default(0);
            $table->integer('rrq_hard')->default(0);

            // ERQ
            $table->integer('erq_easy')->default(0);
            $table->integer('erq_medium')->default(0);
            $table->integer('erq_hard')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paper_formats');
    }
};
