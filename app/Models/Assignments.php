<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    use HasFactory;

    // Fillable properties for mass assignment
    protected $fillable = [
        'title',
        'instructions',
        'cohort',
        'deadline',
        'resource',
        'teacher_id',
    ];

    // Relationship to the Teacher model
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class, 'assignment_id');
    }
}
