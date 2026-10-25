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
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string("parent_id")->unique();
            $table->enum('relationship', ['father', 'mother', 'guardian']);

            $table->text("address")->nullable();
            $table->string("phone")->nullable();
            $table->string("occupation")->nullable();
            $table->text("work_address")->nullable();
            $table->integer("national_id")->nullable();

            $table->boolean("is_primary_contact")->default(false);

            $table->boolean("is_active")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parent_models');
    }
};
