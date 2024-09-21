<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'course_id', 
        'quiz_type', 
        'cohort', 
        'start_time', 
        'end_time', 
        'duration'
    ];

    // A quiz belongs to a course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // A quiz has many questions
    public function questions()
    {
        return $this->hasMany(QuizQuestion::class);
    }

    // A quiz has many submissions
    public function submissions()
    {
        return $this->hasMany(QuizSubmission::class);
    }
}
