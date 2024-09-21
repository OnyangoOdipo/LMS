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
        // migrations for quizzes, questions, and submissions
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('course_id');
            $table->enum('quiz_type', ['multiple_choice', 'teacher_reviewed']);
            $table->integer('cohort');
            $table->time('start_time'); // Start time of the quiz
            $table->time('end_time'); // End time of the quiz
            $table->integer('duration')->nullable(); // for timed quizzes
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });

        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_id');
            $table->text('question');
            $table->json('options');
            $table->timestamps();

            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
        });

        Schema::create('quiz_choices', function (Blueprint $table) {
            $table->id();
            $table->text('choice');
            $table->boolean('is_correct');
            $table->unsignedBigInteger('quiz_question_id');
            $table->foreign('quiz_question_id')->references('id')->on('quiz_questions');
            $table->timestamps();
        });

        Schema::create('quiz_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_id');
            $table->unsignedBigInteger('student_id');
            $table->json('answers'); // student's answers
            $table->integer('score')->nullable(); // score for multiple-choice quizzes
            $table->boolean('is_graded')->default(false); // manually graded quizzes
            $table->timestamps();

            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
