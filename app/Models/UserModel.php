<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserModel extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'user', $primaryKey = 'id_user';
    public $timestamps = false, $fillable = [
        'nama_user', 'role', 'username', 'password'
    ];
}
