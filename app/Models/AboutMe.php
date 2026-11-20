<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutMe extends Model
{
    protected $fillable = [
        'judul', 
        'deskripsi', 
        'judul_detail', 
        'deskripsi_detail', 
        'aboutme_gambar'
    ];
}