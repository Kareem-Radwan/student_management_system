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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->string("student_id")->unique();
            $table->date("date_of_birth");
            $table->enum('gender', ['male', 'female']);
            $table->text("address")->nullable();
            $table->string("phone")->nullable();
            $table->string("emergency_contact")->nullable();
            $table->date("admission_date")->nullable();
            
            $table->string("class")->nullable();
            $table->string("section")->nullable();
            $table->string("roll_number")->nullable();

            $table->boolean("is_active")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
