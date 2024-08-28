<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klinik extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'Nama',
        'Nomor_Rekam_Medis',
        'Alamat',
        'Tanggal_Lahir',
        'Jenis_Kelamin',
    ];
}
