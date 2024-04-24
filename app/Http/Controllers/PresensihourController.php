<?php

namespace App\Http\Controllers;

use App\Models\PresensiHour;
use Illuminate\Http\Request;

class PresensihourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $presensihour = PresensiHour::all();
        return view('presensihour.index', [
            'presensihour' => $presensihour
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function day()
    {
        return ['sunday',
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday'];
    }

    public function create()
    {
        return view('presensihour.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'ph_name' => 'required',
            'ph_desc' => 'required',
            'ph_time_start' => 'required',
            'ph_time_end' => 'required',
        ]);
        PresensiHour::create([
            'ph_name' => $request->ph_name,
            'ph_desc' => $request->ph_desc,
            'ph_time_start' => $request->ph_time_start,
            'ph_time_end' => $request->ph_time_end,
        ]);
        // dd($request->all());
        return redirect()->action('App\Http\Controllers\PresensihourController@index')->with('message','Data added Successfully');
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
        $presensihour = PresensiHour::findOrFail($id);
        return view('presensihour.edit', compact('presensihour'));
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
        $presensihour = \App\Models\Presensihour::findOrFail($id);
        $presensihour->name = $request->get('ph_name');
        $presensihour->ph_desc = $request->get('ph_desc');
        $presensihour->ph_time_start = $request->get('ph_time_start)');
        $presensihour->ph_time_end = $request->get('ph_time_end');
        $presensihour->save();

          //redirect to index
          return redirect()->route('presensihour.index')->with(['message' => 'Data Berhasil Di Update!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $presensihour = presensihour::findOrFail($id);
        $presensihour->delete();

        if ($presensihour) {
            return redirect()
                ->route('presensihour.index')
                ->with('error','Data Deleted Successfully');
        } else {
            return redirect()
                ->route('presensihour.index')
                ->with('error','Data Deleted Successfully');
        }
    }
}
