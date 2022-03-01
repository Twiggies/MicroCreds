<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'institute_name',
        'institute_logo',
        'certificate_name',
        'educator_signature',
        'educator_title'
    ];
}
