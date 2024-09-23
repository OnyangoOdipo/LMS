<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'student_id',
        'submission_file',
        'score',
    ];

    public function assignment()
    {
        return $this->belongsTo(Assignments::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class);
    }
}
