<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galery;
use Illuminate\Support\Facades\DB;

class GaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galery = DB::table('galery')->get();
        return view('galery.index', ['galery' => $galery]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('galery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirim oleh form
    $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan persyaratan berkas gambar
        'description' => 'required|string',
    ]);

    // Mengunggah berkas gambar
    $imagePath = $request->file('image')->store('gallery_images', 'public');

    // Membuat entri galeri baru dalam database
    Galery::create([
        'title' => $request->input('title'),
        'author' => $request->input('author'),
        'image' => $imagePath,
        'description' => $request->input('description'),
    ]);

    return redirect()
    ->route('galery.index')
    ->with('message','Data Added Successfully');
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
        return view('galery.edit');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $galery = Galery::findOrFail($id);
        $galery->delete();

        if ($galery) {
            return redirect()
                ->route('galery.index')
                ->with('error','Data Deleted Successfully');
        } else {
            return redirect()
                ->route('galery.index')
                ->with('error','Data Deleted Successfully');
        }
    }
}
