<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $fillable = [
        'judul', 
        'deskripsi_singkat', 
        'nama_pengirim', 
        'email_pengirim', 
        'pesan_pengirim', 
        'media_sosial',
        'link_github',
        'link_linkedin',
        'link_instagram'
    ];
}