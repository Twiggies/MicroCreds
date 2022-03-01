<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialBridge extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'materials_id'
    ];

    public function materials() {
        return $this->hasMany(Material::class);
    }

    public function lessons() {
        return $this->hasMany(Lesson::class);
    }
}
