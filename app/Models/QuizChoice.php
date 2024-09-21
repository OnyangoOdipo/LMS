<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizChoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_question_id', 
        'choice', 
        'is_correct'
    ];

    // A choice belongs to a question
    public function question()
    {
        return $this->belongsTo(QuizQuestion::class, 'quiz_question_id');
    }
}
