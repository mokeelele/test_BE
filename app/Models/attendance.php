<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_user',
        'clock_in',
        'photo',
    ];

    public $table = 'attendance';
}
