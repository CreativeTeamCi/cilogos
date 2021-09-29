<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'email',
        'business_name',
        'file_svg',
        'file_png',
        'status',
        'url'
    ];
}
