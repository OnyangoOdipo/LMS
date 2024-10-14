<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    protected $dates = ['start_time', 'end_time'];

    public function getStartTimeAttribute($value)
    {
        return Carbon::parse($value)->setTimezone('Africa/Nairobi');
    }

    public function getEndTimeAttribute($value)
    {
        return Carbon::parse($value)->setTimezone('Africa/Nairobi');
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = Carbon::parse($value, 'Africa/Nairobi')->setTimezone('UTC');
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = Carbon::parse($value, 'Africa/Nairobi')->setTimezone('UTC');
    }

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
