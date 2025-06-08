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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('course_offering_code');
            $table->string('title');
            $table->string('offering_day');
            $table->string('offering_time');
            $table->string('classroom_number');
            $table->foreignId('instructor_id')->constrained('users');
            $table->date('exam_date')->nullable();
            $table->timestamps();
        });

        Schema::create('lesson_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_user');
        Schema::dropIfExists('lessons');
    }
};
