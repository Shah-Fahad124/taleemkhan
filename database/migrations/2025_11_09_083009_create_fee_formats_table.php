<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('fee_formats', function (Blueprint $table) {
            $table->id();

            // Add the column first
            $table->unsignedBigInteger('school_id'); // school foreign key
            $table->unsignedBigInteger('class_id');  // linked to grades/classes table

            $table->decimal('monthly_fee', 10, 2)->default(0);
            $table->decimal('transport_fee', 10, 2)->default(0);
            $table->decimal('computer_fee', 10, 2)->default(0);
            $table->decimal('total_fee', 10, 2)->default(0);
            $table->timestamps();

            // Then define foreign keys
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('grades')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_formats');
    }
};

