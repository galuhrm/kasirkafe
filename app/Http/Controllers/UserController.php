<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    public function getUser()
    {
        $dt_user = UserModel::get();
        return response()->json($dt_user);
    }

    public function addUser(request $req)
    {
        $validator = validator::make($req->all(), [
            'nama_user' => 'required',
            'role' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }
        $save = UserModel::create([
            'nama_user' => $req->get('nama_user'),
            'role' => $req->get('role'),
            'username' => $req->get('username'),
            'password' => Hash::make($req->get('password')),
        ]);
        if ($save) {
            return response()->json(['status' => true, 'message' => 'berhasil menambahkan user']);
        } else {
            return response()->json(['status' => false, 'message' => 'gagal menambahkan user']);
        }
    }

    public function updateUser(Request $req, $id_user)
    {
        $validator = Validator::make($req->all(), [
            'nama_user' => 'required',
            'role' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }
        $ubah = UserModel::where('id_user', $id_user)->update([
           'nama_user' => $req->get('nama_user'),
            'role' => $req->get('role'),
            'username' => $req->get('username'),
            'password' => Hash::make($req->get('password')),
        ]);
        if ($ubah) {
            return response()->json(['status' => true, 'message' => 'berhasil mengedit user']);
        } else {
            return response()->json(['status' => false, 'message' => 'gagal mengedit user']);
        }
    }

    public function getUserID($id_user)
    {
        $dt=UserModel::where('id',$id_user)->first();
        return response()->json($dt);
    }

    public function deleteUser($id_user)
    {
        $hapus=UserModel::where('id_user',$id_user)->delete();
        if($hapus){
            return response()->json(['status' => true, 'message' => 'Sukses Hapus Data user']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal Hapus Data user']);
        }
    }
}