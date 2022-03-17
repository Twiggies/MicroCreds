<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseLibraryBridge extends Model
{
    protected $table = 'course_libraries_bridges';
    use HasFactory;

    protected $fillable = [
        'course_id',
        'library_id',
    ];

    
}
