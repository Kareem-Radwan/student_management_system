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
        Schema::create('school_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('teachers')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->string('name');
            $table->string('department');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('class_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_class_id')->constrained('school_classes')->cascadeOnDelete();
            $table->string('day');
            $table->time("start_time");
            $table->time("end_time");
            $table->timestamps();
        });

        Schema::create('class_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_class_id')->constrained('school_classes')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->unique(['school_class_id', 'student_id']);
            $table->timestamps();
        });

        Schema::create('class_join_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_class_id')->constrained('school_classes')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->string('status')->default('pending');
            $table->unique(['school_class_id', 'student_id']);
            $table->timestamps();
        });

        Schema::create('class_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_class_id')->constrained('school_classes')->cascadeOnDelete();
            $table->string('title');
            $table->string('file_path');
            $table->string('original_name');
            $table->timestamps();
        });

        Schema::create('class_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_class_id')->constrained('school_classes')->cascadeOnDelete();
            $table->text('caption');
            $table->string('image_path')->nullable();
            $table->unsignedInteger('max_marks')->default(100);
            $table->timestamps();
        });

        Schema::create('post_grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_post_id')->constrained('class_posts')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->decimal('marks', 5, 2);
            $table->text('notes');
            $table->unique(['class_post_id', 'student_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_classes');
        Schema::dropIfExists('class_schedules');
        Schema::dropIfExists('class_student');
        Schema::dropIfExists('class_join_requests');
        Schema::dropIfExists('class_materials');
        Schema::dropIfExists('class_posts');
        Schema::dropIfExists('post_grades');
    }
};
