<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Redirect;


class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengumuman = Pengumuman::all();
        return view('pengumuman.index', [
            'pengumuman' => $pengumuman
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'status' => 'required',
            'image_file' => 'required|image|mimes:jpeg,jpg,png|max:400',
            'tipe_peserta' => 'required',
        ], [
            // Custom error messages
            'name.required' => 'Nama harus diisi',
            'desc.required' => 'Deskripsi harus diisi',
            'status.required' => 'Status harus dipilih',
            'image_file.required' => 'File gambar harus diunggah',
            'image_file.image' => 'File harus berupa gambar',
            'image_file.mimes' => 'File harus berformat jpeg atau jpg',
            'image_file.max' => 'Ukuran file tidak boleh melebihi 400 KB',
            'tipe_peserta.required' => 'Tipe peserta harus dipilih',
        ]);

        if ($request->hasFile('image_file')) {
            $avatarFile = $request->file('image_file');
            $avatarName = 'pengumuman_' . now()->format('YmdHis') . '.' . $avatarFile->getClientOriginalExtension();

            // Simpan file gambar ke dalam storage (public disk)
            $avatarFile->storeAs('public/pengumuman', $avatarName);

            $pengumuman = Pengumuman::create([
                'name' => $validatedData['name'],
                'desc' => $validatedData['desc'],
                'status' => $validatedData['status'],
                'tipe_peserta' => $validatedData['tipe_peserta'],
                'image_file' => $avatarName, // Simpan nama file gambar yang digenerate
            ]);

            return Redirect::back()->with('message', 'Data added successfully');
        } else {
            return Redirect::back()->with('error', 'No image file uploaded');
        }
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
        $pengumuman = Pengumuman::findOrFail($id);
        return view('pengumuman.edit', compact('pengumuman', 'id'));
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
        // Validasi request jika diperlukan
        $validatedData = $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'status' => 'required',
            'image_file' => 'image|mimes:jpeg,jpg,png|max:400', // Berikan keterangan image sebagai opsional jika tidak ingin diubah
            'tipe_peserta' => 'required',
        ]);

        // Ambil data pengumuman berdasarkan ID
        $pengumuman = Pengumuman::findOrFail($id);
        // Perbarui nilai-nilai pengumuman berdasarkan input dari form
        $pengumuman->name = $request->input('name');
        $pengumuman->desc = $request->input('desc');
        $pengumuman->status = $request->input('status');
        $pengumuman->tipe_peserta = $request->input('tipe_peserta');

        // Perbarui file gambar jika ada file baru di-upload
        if ($request->hasFile('image_file')) {
            $avatarFile = $request->file('image_file');
            $avatarName = 'pengumuman_' . now()->format('YmdHis') . '.' . $avatarFile->getClientOriginalExtension();
            $avatarFile->storeAs('public/pengumuman', $avatarName);
            // Hapus file gambar lama jika diperlukan
            // Storage::delete('public/pengumuman/' . $pengumuman->image_file);
            $pengumuman->image_file = $avatarName;
        }
        // Simpan perubahan ke database
        $pengumuman->save();
        // Redirect ke halaman yang sesuai setelah update
        return redirect()->route('nama_route_ke_halaman_edit')->with('success', 'Pengumuman berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->delete();

        if ($pengumuman) {
            return redirect()
                ->route('pengumuman.index')
                ->with('error','Data Deleted Successfully');
        } else {
            return redirect()
                ->route('pengumuman.index')
                ->with('error','Data Deleted Successfully');
        }
    }
}
