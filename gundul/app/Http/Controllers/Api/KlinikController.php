<?php

namespace App\Http\Controllers\Api;

//import model Produk
use App\Models\Klinik;

use App\Http\Controllers\Controller;
//import resource ProdukResource
use App\Http\Resources\KlinikResource;

//import resources ProdukResource
use Illuminate\Http\Request;

//import facade Validator
use Illuminate\Support\Facades\Validator;

//import facade Storage
use Illuminate\Support\Facades\Storage;

class KlinikController extends Controller
{    
    public function index()
    {
        //get all posts
        $kliniks = Klinik::latest()->paginate(5);

        //return collection of posts as a resource
        return new KlinikResource(true, 'List Data pasien', $kliniks);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'Nama'  => 'required|string|max:255',  
            'Nomor_Rekam_Medis' => 'required|string|max:255',
            'Alamat'  => 'required|string|max:255',
            'Tanggal_Lahir' => 'required|string|max:255',
            'Jenis_Kelamin' => 'required|string|max:255',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $kliniks = Klinik::create([
            'Nama'     => $request->Nama,
            'Nomor_Rekam_Medis'     => $request->Nomor_Rekam_Medis,
            'Alamat'   => $request->Alamat,
            'Tanggal_Lahir'   => $request->Tanggal_Lahir,
            'Jenis_Kelamin'   => $request->Jenis_Kelamin,
        ]);

        //return response
        return new KlinikResource(true, 'Data Pasien Berhasil Ditambahkan!', $kliniks);
    }

    public function show($id)
    {
        //find post by ID
        $kliniks = Klinik::find($id);

        //return single post as a resource
        return new KlinikResource(true, 'Detail Data Pasien!', $kliniks);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'Nama'  => 'required|string|max:255',  
            'Nomor_Rekam_Medis' => 'required|string|max:255',
            'Alamat'  => 'required|string|max:255',
            'Tanggal_Lahir' => 'required|string|max:255',
            'Jenis_Kelamin' => 'required|string|max:255',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $kliniks = Klinik::find($id);

            //update post with new image
            $kliniks->update([
                'Nama'     => $request->Nama,
                'Nomor_Rekam_Medis'     => $request->Nomor_Rekam_Medis,
                'Alamat'   => $request->Alamat,
                'Tanggal_Lahir'   => $request->Tanggal_Lahir,
                'Jenis_Kelamin'   => $request->Jenis_Kelamin,
            ]);

        //return response
        return new KlinikResource(true, 'Data Pasien Berhasil Diubah!', $kliniks);
    }

    public function destroy($id)
    {

        //find post by ID
        $kliniks = Klinik::find($id);

        //delete image
        Storage::delete('public/posts/'.basename($kliniks->nama));

        //delete post
        $kliniks->delete();

        //return response
        return new KlinikResource(true, 'Data Pasien Berhasil Dihapus!', null);
    }
}