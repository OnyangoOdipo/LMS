<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('dialect');
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
            $table->integer('duration'); // in minutes or hours
            $table->decimal('price', 8, 2); // max price 999,999.99
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
