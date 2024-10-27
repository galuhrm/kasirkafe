<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TransaksiModel extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'transaksi', $primaryKey = 'id_transaksi';
    public $timestamps = false, $fillable = [
        'tgl_transaksi', 'id_user', 'id_meja', 'nama_pelanggan', 'status'
    ];
}
