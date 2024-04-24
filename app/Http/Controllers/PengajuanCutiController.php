<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanCuti;
use DataTable;
use App\Models\User;
use App\Models\School;

class PengajuanCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftarPegawai = User::with(['school' => function ($query) {
            $query->select('id', 'name'); // Pilih kolom yang ingin Anda muat
        }])->get();
        $data = PengajuanCuti::with('user')->get();
        return view('pengajuancuti.index',compact('data','daftarPegawai'));
    }

    public function DataTable(Request $request)
    {
        if ($request->ajax()) {
            $pengajuancuti = PengajuanCuti::all();
            return DataTables::of($pengajuancuti)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('pegawai', function($item) {
                    return $item->pegawai ? $itempegawai->name : '-';
                })
                ->addColumn('tanggal_awal', function ($item) {
                    return $item->tanggal_awal; // Sesuaikan dengan nama kolom pada model PengajuanCuti
                })
                ->addColumn('tanggal_akhir', function ($item) {
                    return $item->tanggal_akhir; // Sesuaikan dengan nama kolom pada model PengajuanCuti
                })
                ->addColumn('status', function ($item) {
                    return $item->status; // Sesuaikan dengan nama kolom pada model PengajuanCuti
                })
                ->addColumn('lampiran', function ($item) {
                    return $item->lampiran; // Sesuaikan dengan nama kolom pada model PengajuanCuti
                })
                ->addColumn('action', function ($pengajuancuti) {
                    $editBtn = '<a href="' . route('pengajuancuti.edit', $pengajuancuti->id) . '" class="edit btn btn-sm btn-info" style="color: #fff;background-color: #3DCB3A;border-color: #8ad3d3"> <i class="fa fa-edit"></i> Edit </a>';
                    $deleteBtn = '<form onsubmit="return confirm(\'Apakah Anda Yakin ?\');" action="' . route('pengajuancuti.destroy', $pengajuancuti->id) . '" method="POST">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                                </form>';
                    return $editBtn . $deleteBtn;
                })
                ->rawColumns(['action','pegawai','tanggal_awal','tanggal_akhir','status','lampiran'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Misalnya, jika Anda ingin membuat pengajuan cuti baru
        $newPengajuanCuti = new PengajuanCuti();
        // $daftarPegawai = User::all();
        $daftarPegawai = User::with(['school' => function ($query) {
            $query->select('id', 'name'); // Pilih kolom yang ingin Anda muat
        }])->get();
        // ...
        // Jika Anda ingin menampilkan detail pengguna terkait dari pengajuan cuti baru
        $user = $newPengajuanCuti->user;
        return view('pengajuancuti.create-pengajuancuti', compact('newPengajuanCuti','user','daftarPegawai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            // 'pegawai' => 'required', // Sesuaikan dengan aturan validasi Anda
            'tanggal' => 'required',
            'status' => 'required',
            'lampiran' => 'file', // Sesuaikan dengan aturan validasi untuk file
        ]);


        // Simpan data pengajuan cuti ke dalam database
        $pengajuanCuti = new PengajuanCuti();
        $pengajuanCuti->pegawai = $request->pegawai;
        // $pengajuanCuti->tanggal = $request->tanggal;
        // Mendapatkan rentang tanggal dari input form
        $rentangTanggal = $request->input('tanggal');

        // Memisahkan rentang tanggal menjadi tanggal mulai dan tanggal akhir
        $rentangArray = explode(' to ', $rentangTanggal);

        $tanggalMulai = $rentangArray[0]; // Mendapatkan tanggal mulai
        $tanggalAkhir = $rentangArray[1]; // Mendapatkan tanggal akhir

        // Simpan data ke dalam dua kolom yang berbeda di tabel
        $pengajuanCuti = new PengajuanCuti();
        $pengajuanCuti->tanggal_awal = $tanggalMulai;
        $pengajuanCuti->tanggal_akhir = $tanggalAkhir;
        $pengajuanCuti->status = $request->status;

        // Upload lampiran jika ada
        if ($request->hasFile('lampiran')) {
            $lampiran = $request->file('lampiran');

            // Generate nama file baru berdasarkan tanggal, nama pengguna, dan ekstensi asli
            $namaFile = 'lampiran_' . date('Ymd') . '_' . $request->user()->name . '.' . $lampiran->getClientOriginalExtension();

            // Simpan file dengan nama baru ke dalam folder 'lampiran' di dalam folder 'storage/app/public'
            $lampiran->storeAs('lampiran', 'public');

            // Simpan nama file lampiran ke dalam database
            $pengajuanCuti->lampiran = $namaFile;
        }
        // dd($request->all());
        $pengajuanCuti->save();

        // Redirect ke halaman lain atau tampilkan pesan berhasil sesuai kebutuhan Anda
        return redirect()->back()->with('message', 'Pengajuan cuti berhasil disimpan.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Mengambil data pengajuan cuti berdasarkan ID
        $pengajuanCuti = PengajuanCuti::findOrFail($id);
        $daftarPegawai = User::with(['school' => function ($query) {
            $query->select('id', 'name'); // Pilih kolom yang ingin Anda muat
        }])->get();

        // Misalnya, jika Anda ingin menampilkan form edit dengan data pengajuan cuti
        return view('pengajuancuti.edit', compact('pengajuanCuti','daftarPegawai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'pegawai' => 'required', // Sesuaikan dengan aturan validasi Anda
            'tanggal' => 'required',
            'status' => 'required',
            'lampiran' => 'file', // Sesuaikan dengan aturan validasi untuk file
        ]);

        // Mengambil data pengajuan cuti berdasarkan ID
        $pengajuanCuti = PengajuanCuti::findOrFail($id);

        // Simpan data yang diterima dari formulir ke dalam model
        $pengajuanCuti->pegawai = $request->pegawai;

        $rentangTanggal = $request->input('tanggal');
        $rentangArray = explode(' to ', $rentangTanggal);
        $tanggalMulai = $rentangArray[0];
        $tanggalAkhir = $rentangArray[1];

        $pengajuanCuti->tanggal_awal = $tanggalMulai;
        $pengajuanCuti->tanggal_akhir = $tanggalAkhir;
        $pengajuanCuti->status = $request->status;

        // Upload lampiran jika ada
        if ($request->hasFile('lampiran')) {
            $lampiran = $request->file('lampiran');
            $namaFile = 'lampiran_' . date('Ymd') . '_' . $request->user()->name . '.' . $lampiran->getClientOriginalExtension();
            $lampiran->storeAs('lampiran', $namaFile, 'public');
            $pengajuanCuti->lampiran = $namaFile;
        }

        // Simpan perubahan ke dalam database
        $pengajuanCuti->save();

        // Redirect ke halaman lain atau tampilkan pesan berhasil sesuai kebutuhan Anda
        return redirect()->route('pengajuancuti.index')->with('message', 'Pengajuan cuti berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengajuancuti = Pengajuancuti::findOrFail($id);
        $pengajuancuti->delete();

        if ($pengajuancuti) {
            return redirect()
                ->route('pengajuancuti.index')
                ->with('error','Data Deleted Successfully');
        } else {
            return redirect()
                ->route('pengajuancuti.index')
                ->with('error','Data Deleted Successfully');
        }
    }

    public function downloadLampiran($filename)
    {
        $path = public_path('storage/lampiran/' . $filename);

        return response()->download($path, $filename, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    public function dropzone()
    {
        $files = scandir(public_path('images'));
        $data = [];
        foreach ($files as $row) {
            if ($row != '.' && $row != '..') {
                $data[] = [
                    'name' => explode('.', $row)[0],
                    'url' => asset('images/' . $row)
                ];
            }
        }
        return view('welcome', compact('data'));
    }

    public function dropzoneStore(Request $request)
    {
        $image = $request->file('file');

        $imageName = time() . '-' . strtoupper(Str::random(10)) . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);

        return response()->json(['success'=> $imageName]);
    }
}
