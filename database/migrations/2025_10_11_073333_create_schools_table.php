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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('emis_code', 50)->unique(); // Unique school EMIS code
            $table->string('school_name', 255);
            $table->enum('school_level', ['Primary', 'Middle', 'High']); // fixed 3 levels
            $table->foreignId('district_id')->constrained('districts')->onDelete('restrict');
            $table->foreignId('tehsil_id')->constrained('tehsils')->onDelete('restrict');
            $table->enum('zone', ['Summer Zone', 'Winter Zone']); // only 2 options
            $table->string('head_teacher_name', 255);
            $table->string('head_teacher_phone', 20);
            $table->integer('number_of_teachers')->default(0);
            $table->string('email')->nullable();
            $table->string('password'); // Hashed password for school login
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes(); // Adds a 'deleted_at' column (nullable)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
