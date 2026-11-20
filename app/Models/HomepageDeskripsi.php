<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageDeskripsi extends Model
{
    protected $fillable = [
        'role', 
        'judul_deskripsi', 
        'catatan_utama', 
        'deskripsi'
    ];
}