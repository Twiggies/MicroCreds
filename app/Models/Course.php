<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'image',
        'duration',
        'status'
    ];

    public function modules() {
        return $this->hasMany(Module::class);
    }

    public function bridge() {
        return $this->hasMany(CourseLibraryBridge::class);
    }

    public function enrolls() {
        return $this->hasMany(Enrollment::class);
    }
}
