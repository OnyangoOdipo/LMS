<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'quiz_id',
        'assignment_id',
        'score',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function assignment()
    {
        return $this->belongsTo(Assignments::class);
    }
}
