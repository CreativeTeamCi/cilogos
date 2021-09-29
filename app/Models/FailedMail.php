<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedMail extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'business_name',
        'comment',
        'status',
    ];
}
