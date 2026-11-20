<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'skill_judul', 
        'emoji', 
        'judul_perskill', 
        'isi_skill',
        'level' // <-- PASTIKAN INI ADA
    ];
}