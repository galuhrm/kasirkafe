<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MejaModel extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'meja', $primaryKey = 'id_meja';
    public $timestamps = false, $fillable = [
        'nomor_meja'
    ];
}
