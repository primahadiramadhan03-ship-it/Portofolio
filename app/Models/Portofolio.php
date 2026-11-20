<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    protected $fillable = [
        'foto', 
        'judul', 
        'deskripsi_singkat', 
        'kategori', 
        'judul_isi', 
        'deskripsi_isi'
    ];
}