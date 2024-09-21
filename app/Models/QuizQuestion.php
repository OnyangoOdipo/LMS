<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id', 
        'question', 
        'options'
    ];

    // A question belongs to a quiz
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    // A question has many choices
    public function choices()
    {
        return $this->hasMany(QuizChoice::class);
    }
}
