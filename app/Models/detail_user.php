<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_user extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_user',
        'jenis_kelamin',
        'no_hp',
    ];

    public $table = 'detail_user';
}
