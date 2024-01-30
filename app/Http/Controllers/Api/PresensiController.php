<?php

namespace App\Http\Controllers\Api;

//import Model "Presensi"
use App\Models\Presensi;
use App\Models\Karyawan;
use App\Exports\PresensiExport;
use App\Imports\PresensiImport;

//import library support
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//import Resource "PresensiResource"
use App\Http\Resources\PresensiResource;

//import Facades "Validator"
use Illuminate\Support\Facades\Validator;

class PresensiController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all presensis
        $presensis = Presensi::all();

        //return collection of presensis as a resource
        return PresensiResource::collection($presensis);
    }

    public function dashboard()
    {
        // Get all presensis with the karyawan relationship loaded
        $presensis = Presensi::with('karyawan')->get();

        // Get all karyawans
        $karyawans = Karyawan::all();

        // Return the 'presensi.dashboardpresen' view with the 'presensis' and 'karyawans' data sets
        return view('presensi.dashboardpresen', ['presensis' => $presensis, 'karyawans' => $karyawans]);
    }

    public function create()
    {
        $karyawans = Karyawan::all();
        return view('presensi.create', compact('karyawans'));
    }

    public function edit($id)
    {
        $presensi = Presensi::find($id);
        $karyawans = Karyawan::all();
        return view('presensi.edit', compact('presensi', 'karyawans'));
    }

    public function destroy($id)
    {
    $presensi = Presensi::find($id);

    if ($presensi) {
        $presensi->delete();
        return redirect('/dashboardpresen');
    } else {
        return response()->json(['message' => 'Presensi not found'], 404);
    }
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //get Presensi
        $presensi = Presensi::find($id);

        //if karyawan was found
        if ($presensi) {
            //return success message
            return response()->json([
                'success' => true,
                'message' => 'Detail presensi!',
                'data'    => $presensi
            ], 200);
        }

        //if karyawan was not found
        else {
            //return error message
            return response()->json([
                'success' => false,
                'message' => 'presensi Not Found!',
            ], 404);
        }
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
            'tanggal'           => 'required',
            'jam_masuk'         => 'required',
            'jam_pulang'        => 'required',
            'presensi_status'   => 'required',
            'id_karyawan'       => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create presensi
        $presensi = Presensi::create([
            'tanggal'           => $request->tanggal,
            'jam_masuk'         => $request->jam_masuk,
            'jam_pulang'        => $request->jam_pulang,
            'presensi_status'   => $request->presensi_status,
            'id_karyawan'       => $request->id_karyawan,
        ]);

        //if presensi was created
        if ($presensi) {
            //return success message
            return response()->json([
                'success' => true,
                'message' => 'presensi Created',
                'data'    => $presensi
            ], 201);
        }

        //if presensi was not created
        else {
            //return error message
            return response()->json([
                'success' => false,
                'message' => 'presensi Failed to Save',
            ], 409);
        }
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $presensi
     * @return void
     */
    public function update(Request $request, $id)
    {
        //get presensi by id
        $presensi = Presensi::find($id);

        //if presensi was found
        if ($presensi) {
            
            //define validation rules
            $validator = Validator::make($request->all(), [
                'tanggal'           => 'required',
                'jam_masuk'         => 'required',
                'jam_pulang'        => 'required',
                'presensi_status'   => 'required',
                'id_karyawan'       => 'required',
            ]);

            //check if validation fails
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            // update presensi
            $presensi->update([
                'tanggal'           => $request->tanggal,
                'jam_masuk'         => $request->jam_masuk,
                'jam_pulang'        => $request->jam_pulang,
                'presensi_status'   => $request->presensi_status,
                'id_karyawan'       => $request->id_karyawan,
            ]);

            // get the updated presensi
            $presensi = Presensi::find($id);
            
            ///return success message
            return response()->json([
                'success' => true,
                'message' => 'Presensi Updated',
                'data'    => $presensi
            ], 200);
        }

        //if presensi was not found
        else {
            //return error message
            return response()->json([
                'success' => false,
                'message' => 'Presensi Not Found!',
            ], 404);
        }
    }

    public function getPresensiAbsenLebih3()
    {
        // Get all karyawan IDs where the count of presensi_status is more than 3
        $karyawanIds = Presensi::groupBy('id_karyawan')
            ->havingRaw('COUNT(presensi_status) >= 3')
            ->pluck('id_karyawan');

        // Get all presensi records for these karyawan IDs
        $presensi = Presensi::whereIn('id_karyawan', $karyawanIds)->get();

        // Check if presensi records were found
        if ($presensi->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No presensi records found',
            ], 404);
        }

        // Return the presensi records
        return response()->json([
            'success' => true,
            'data' => $presensi,
        ], 200);
    }

    public function cekAbsen()
    {
        // Get all presensis
        $presensis = Presensi::with('karyawan')->get();

        // Map over the presensi records to include the employee name
        $presensis = $presensis->map(function ($presensi) {
            // Add the employee name to the presensi record
            $presensi->nama_lengkap = $presensi->karyawan->nama_lengkap;
            return $presensi;
        });

        // Get all karyawans
        $karyawans = Karyawan::all();

        // Return the 'presensi.dashboardpresen' view with the 'presensis' and 'karyawans' data sets
        return view('presensi.cek-absen', ['presensis' => $presensis, 'karyawans' => $karyawans]);
    }

    public function export_excelp()
	{
		return Excel::download(new PresensiExport, 'DataPresensi.xlsx');
	}

    public function import_excelp()
    {
        // validasi
        $this->validate($request, [
        'file' => 'required|mimes:csv,xls,xlsx'
    ]);
    
        // menangkap file excel
        $file = $request->file('file');
    
        // membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('file_karyawan',$nama_file);
 
		// import data
		Excel::import(new KaryawanImport, public_path('/file_karyawan/'.$nama_file));
 
		// notifikasi dengan session
		Session::flash('sukses','Data Karyawan Berhasil Diimport!');
        
		// alihkan halaman kembali
		return redirect('/dashboard');
    }
}
