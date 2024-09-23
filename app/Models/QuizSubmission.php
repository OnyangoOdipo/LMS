<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id', 
        'student_id', 
        'answers', 
        'score', 
        'is_graded',
        'quiz_start_time',
        'quiz_end_time'
    ];

    // A submission belongs to a quiz
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    // A submission belongs to a student
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
