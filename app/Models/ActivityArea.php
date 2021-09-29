<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityArea extends Model
{
    use HasFactory;

    protected $table='activity_areas';

    protected $fillable= [
        'libelle',
        'slug',
    ];
}
