<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MenuModel extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'menu', $primaryKey = 'id_menu';
    public $timestamps = false, $fillable = [
        'nama_menu', 'jenis', 'deskripsi', 'gambar', 'harga'
    ];
}
