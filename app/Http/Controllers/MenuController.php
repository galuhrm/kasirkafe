<?php

namespace App\Http\Controllers;

use App\Models\MenuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    public function getMenu()
    {
        $dt_menu = MenuModel::get();
        return response()->json($dt_menu);
    }

    public function addMenu(request $req)
    {
        $validator = validator::make($req->all(), [
            'nama_menu' => 'required',
            'jenis' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|max:2048', // Validasi gambar
            'harga' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }
    
        // Handle image upload
        if ($req->hasFile('gambar')) {
            $image = $req->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            // Simpan gambar di folder 'menu'
            $imagePath = $image->storeAs('menu', $imageName, 'public'); // Menyimpan di storage/app/public/menu
            $data['gambar'] = $imagePath; // Update image path in the database
        }
    
        $save = MenuModel::create([
            'nama_menu' => $req->get('nama_menu'),
            'jenis' => $req->get('jenis'),
            'deskripsi' => $req->get('deskripsi'),
            'gambar' => isset($data['gambar']) ? $data['gambar'] : null, // Cek jika gambar diupload
            'harga' => $req->get('harga'),
        ]);
    
        if ($save) {
            return response()->json(['status' => true, 'message' => 'Berhasil menambahkan menu']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal menambahkan menu']);
        }
    }
    

    public function updateMenu(Request $req, $id_menu)
    {
        $validator = Validator::make($req->all(), [
            'nama_menu' => 'required',
            'jenis' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required',
            'harga' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }
        $ubah = MenuModel::where('id_menu', $id_menu)->update([
            'nama_menu' =>  $req->get('nama_menu'),
            'jenis' =>  $req->get('jenis'),
            'deskripsi' =>  $req->get('deskripsi'),
            'gambar' =>  $req->get('gambar'),
            'harga' =>  $req->get('harga'),

        ]);
        if ($ubah) {
            return response()->json(['status' => true, 'message' => 'berhasil mengedit menu']);
        } else {
            return response()->json(['status' => false, 'message' => 'gagal mengedit menu']);
        }
    }

    public function getMenuId($id_menu)
    {
        $dt=MenuModel::where('id',$id_menu)->first();
        return response()->json($dt);
    }

    public function deleteMenu($id_menu)
    {
        $hapus=MenuModel::where('id_menu',$id_menu)->delete();
        if($hapus){
            return response()->json(['status' => true, 'message' => 'Sukses Hapus Data menu']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal Hapus Data menu']);
        }


    }
}