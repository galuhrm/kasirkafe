<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksiModel extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'detail_transaksi', $primaryKey = 'id_detail_transaksi';
    public $timestamps = false, $fillable = [
        'id_transaksi', 'id_menu', 'harga', 'jumlah_produk'
    ];
}
