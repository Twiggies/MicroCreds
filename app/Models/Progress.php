<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $table = 'student_progress';
    use HasFactory;
    protected $fillable = [
        'user_id',
        'course_id',
        'module_id',
        'lesson_id',
        'quiz_completed',
    ];

}
