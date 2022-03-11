<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $table = "achievement";
    use HasFactory;
    protected $fillable = [
        'user_id',
        'cert_name'
    ];
}
