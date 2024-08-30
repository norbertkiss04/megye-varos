<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Varos extends Model
{
    protected $table = 'varos';
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['nev', 'megye_id'];
}
