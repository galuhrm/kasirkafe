<?php

namespace App\Http\Controllers;

use App\Models\MejaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class MejaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    public function getMeja()
    {
        $dt_meja = MejaModel::get();
        return response()->json($dt_meja);
    }

    public function addMeja(request $req)
    {
        $validator = validator::make($req->all(), [
            'nomor_meja' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }
        $save = MejaModel::create([
            'nomor_meja' => $req->get('nomor_meja'),
        
        ]);
        if ($save) {
            return response()->json(['status' => true, 'message' => 'berhasil menambahkan meja']);
        } else {
            return response()->json(['status' => false, 'message' => 'gagal menambahkan meja']);
        }
    }

    public function updateMeja(Request $req, $id)
    {
        // Fixed variable naming to $id
        $ubah = MejaModel::where('id_meja', $id)->update([
            'nomor_meja' => $req->get('nomor_meja'),
        ]);
    
        if ($ubah) {
            return response()->json(['status' => true, 'message' => 'berhasil mengedit meja']);
        } else {
            return response()->json(['status' => false, 'message' => 'gagal mengedit meja']);
        }
    }



    public function getMejaId($id_meja)
    {
        $dt=MejaModel::where('id',$id_meja)->first();
        return response()->json($dt);
    }

    public function deleteMeja($id_meja)
    {
        $hapus=MejaModel::where('id_meja',$id_meja)->delete();
        if($hapus){
            return response()->json(['status' => true, 'message' => 'Sukses Hapus Data meja']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal Hapus Data meja']);
        }
    }
}