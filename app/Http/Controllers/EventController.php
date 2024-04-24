<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventModel;
use DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = DB::table('presensis_event')->get();
        return view('event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event.create-event');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'event_name' => 'required|string|max:255',
            'event_desc' => 'required|string',
            'event_start_time' => 'required',
            'event_end_time' => 'required',
            'event_location_name' => 'required',
            'ph_id' => 'required|string|max:255',
            'event_location_name' => 'required',
            'event_tipe_peserta' => 'required|string',
            'event_date' => 'required|string',
            'event_lat' => 'required|string',
            'event_lng' => 'required|string',
            'event_radius' => 'required|numeric',
            // Add other fields and validation rules as needed
        ]);
        // Menyimpan data yang telah divalidasi ke dalam database
        $event = new Event();
        $event->event_name = $validatedData['event_name'];
        $event->event_desc = $validatedData['event_desc'];
        $event->ph_id = $validatedData['ph_id'];
        $event->event_location_name = $validatedData['event_location_name'];
        $event->event_tipe_peserta = $validatedData['event_tipe_peserta']; // Kunci yang sudah diperbaiki di sini
        $event->event_start_time = $validatedData['event_start_time'];
        $event->event_end_time = $validatedData['event_end_time'];
        $event->event_date = $validatedData['event_date'];
        $event->event_lat = $validatedData['event_lat'];
        $event->event_lng = $validatedData['event_lng'];
        $event->event_radius = $validatedData['event_radius'];
        // Menyimpan data acara
        // dd($request->all());
        $event->save();
        // Redirect to a specific page after successfully saving the event
        return redirect()
            ->route('event.index')
            ->with(['message' => 'Data Berhasil Ditambah!!']);
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
    // public function edit($id)
    // {
    //     return view('event.edit');
    // }
    public function edit($id)
    {
        // Mendapatkan data event berdasarkan ID
        $event = Event::find($id);

        // Mengecek apakah event dengan ID yang diberikan ditemukan
        if (!$event) {
            // Redirect atau tampilkan pesan error jika event tidak ditemukan
            return redirect()->route('event.index')->with('error', 'Event tidak ditemukan');
        }

        // Mengirim data event ke halaman edit
        return view('event.edit', compact('event'));
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
    // Validate the incoming request data
    $validatedData = $request->validate([
        'event_name' => 'required|string|max:255',
        'event_desc' => 'required|string',
        'event_start_time' => 'required',
        'event_end_time' => 'required',
        'event_location_name' => 'required',
        'ph_id' => 'required|string|max:255',
        'event_location_name' => 'required',
        'event_tipe_peserta' => 'required|string',
        'event_date' => 'required|string',
        'event_lat' => 'required|string',
        'event_lng' => 'required|string',
        'event_radius' => 'required|numeric',
        // Add other fields and validation rules as needed
    ]);

    // Menemukan dan mengambil data acara berdasarkan ID
    $event = Event::findOrFail($id);

    // Mengupdate data acara dengan data yang telah divalidasi
    $event->update([
        'event_name' => $validatedData['event_name'],
        'event_desc' => $validatedData['event_desc'],
        'ph_id' => $validatedData['ph_id'],
        'event_location_name' => $validatedData['event_location_name'],
        'event_tipe_peserta' => $validatedData['event_tipe_peserta'],
        'event_start_time' => $validatedData['event_start_time'],
        'event_end_time' => $validatedData['event_end_time'],
        'event_date' => $validatedData['event_date'],
        'event_lat' => $validatedData['event_lat'],
        'event_lng' => $validatedData['event_lng'],
        'event_radius' => $validatedData['event_radius'],
        // Update other fields as needed
    ]);

    // Redirect to a specific page after successfully updating the event
    return redirect()
        ->route('event.index')
        ->with(['message' => 'Data Berhasil Diupdate!!']);
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
        $event = event::findOrFail($id);
        $event->delete();

        if ($event) {
            return redirect()
                ->route('event.index')
                ->with('error', 'Data Deleted Successfully');
        } else {
            return redirect()
                ->route('event.index')
                ->with('error', 'Data Deleted Successfully');
        }
    }
}
