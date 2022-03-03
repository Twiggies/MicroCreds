<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
        
    ];
    public function quiz() {
        return $this->hasMany(Quiz::class);
    }

    public function module() {
        return $this->belongsTo(Module::class);
    }

    public function material_link() {
        return $this->hasMany(MaterialBridge::class);
    }
}
