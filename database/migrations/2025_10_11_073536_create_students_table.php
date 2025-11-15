<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            // Personal Info
            $table->string('full_name');
            $table->string('father_name')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('birth_certificate_number')->nullable();

            // Contact Info
            $table->text('current_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('section')->nullable();

            // Academic Info
            $table->foreignId('grade_id')->constrained('grades')->onDelete('cascade');
            $table->enum('status', ['active', 'inactive', 'graduated', 'transferred'])->default('active');

            // School
            $table->foreignId('school_id')->constrained('schools')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
