<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseLibrary extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function courses() {
        return $this->hasMany(Course::class);
    }

    public function bridge() {
        return $this->hasMany(CourseLibraryBridge::class);
    }
}
