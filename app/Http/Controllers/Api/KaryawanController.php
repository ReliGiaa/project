<?php

namespace App\Http\Controllers\Api;

//import Model
use App\Models\Karyawan;
use App\Models\User;
use App\Exports\KaryawanExport;
use App\Imports\KaryawanImport;

//import library support
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//import Resource "KaryawanResource"
use App\Http\Resources\KaryawanResource;

//import Facades "Validator"
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all karyawans
        $karyawans = Karyawan::all();

        //return collection of karyawans as a resource
        // return new KaryawanResource('ini nama', 'ini nomor induk', 'ini alamat', 'ini cabang', 'ini organisasi', 'ini jabatan', 'ini level jabatan', 'ini id user', $karyawans);
        return KaryawanResource::collection($karyawans);
    }

    public function create()
    {
        $users = User::all();
        return view('karyawan.create', compact('users'));
    }

    public function edit($id)
    {
        $karyawan = Karyawan::find($id);
        $users = User::all();
        return view('karyawan.edit', compact('karyawan', 'users'));
    }

    public function destroy($id)
    {
    $karyawan = Karyawan::find($id);

    if ($karyawan) {
        $karyawan->delete();
        return redirect('/dashboard');
    } else {
        return response()->json(['message' => 'Karyawan not found'], 404);
    }
    }
    
    public function import()
    {
        $karyawans = Karyawan::all();
        return view('karyawan.import', compact('karyawans'));
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama_lengkap'          => 'required',
            'nomor_induk_karyawan'  => 'required',
            'alamat'                => 'required',
            'cabang'                => 'required',
            'organisasi'            => 'required',
            'jabatan'               => 'required',
            'level_jabatan'         => 'required',
            'id_user'               => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create karyawan
        $karyawan = Karyawan::create([
            'nama_lengkap'          => $request->nama_lengkap,
            'nomor_induk_karyawan'  => $request->nomor_induk_karyawan,
            'alamat'                => $request->alamat,
            'cabang'                => $request->cabang,
            'organisasi'            => $request->organisasi,
            'jabatan'               => $request->jabatan,
            'level_jabatan'         => $request->level_jabatan,
            'id_user'               => $request->id_user,
        ]);

        //if karyawan was created
        if ($karyawan) {
            //return success message
            return response()->json([
                'success' => true,
                'message' => 'Karyawan Created',
                'data'    => $karyawan
            ], 201);
        }

        //if karyawan was not created
        else {
            //return error message
            return response()->json([
                'success' => false,
                'message' => 'Karyawan Failed to Save',
            ], 409);
        }
    }

    /**
     * show
     *
     * @param  mixed $karyawan
     * @return void
     */
    public function show($id)
    {
        //find karyawan by ID
        $karyawan = Karyawan::find($id);

        //if karyawan was found
        if ($karyawan) {
            //return success message
            return response()->json([
                'success' => true,
                'message' => 'Detail Karyawan!',
                'data'    => $karyawan
            ], 200);
        }

        //if karyawan was not found
        else {
            //return error message
            return response()->json([
                'success' => false,
                'message' => 'Karyawan Not Found!',
            ], 404);
        }
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $karyawan
     * @return void
     */
    public function update(Request $request, $id)
    {
        //find karyawan by ID
        $karyawan = Karyawan::find($id);

        //if karyawan was found
        if ($karyawan) {

            //define validation rules
            $validator = Validator::make($request->all(), [
                'nama_lengkap'          => 'required',
                'nomor_induk_karyawan'  => 'required',
                'alamat'                => 'required',
                'cabang'                => 'required',
                'organisasi'            => 'required',
                'jabatan'               => 'required',
                'level_jabatan'         => 'required',
                'id_user'               => 'required',
            ]);

            //check if validation fails
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            //update karyawan
            $karyawan = $karyawan->update([
                'nama_lengkap'          => $request->nama_lengkap,
                'nomor_induk_karyawan'  => $request->nomor_induk_karyawan,
                'alamat'                => $request->alamat,
                'cabang'                => $request->cabang,
                'organisasi'            => $request->organisasi,
                'jabatan'               => $request->jabatan,
                'level_jabatan'         => $request->level_jabatan,
                'id_user'               => $request->id_user,
            ]);

            //return success message
            return response()->json([
                'success' => true,
                'message' => 'Karyawan Updated',
                'data'    => $karyawan
            ], 200);
        }

        //if karyawan was not found
        else {
            //return error message
            return response()->json([
                'success' => false,
                'message' => 'Karyawan Not Found!',
            ], 404);
        }
    }

    public function export_excel()
	{
		return Excel::download(new KaryawanExport, 'DataKaryawan.xlsx');
	}
}
