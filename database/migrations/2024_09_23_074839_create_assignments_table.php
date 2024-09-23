<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('assignments', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('instructions');
        $table->string('cohort');
        $table->timestamp('deadline');
        $table->string('resource')->nullable(); // Optional resource
        $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade'); // Assuming the teacher is assigning
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
