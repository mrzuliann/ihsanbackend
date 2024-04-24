<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;
use Illuminate\Support\Facades\DB;
use App\Models\School;
use App\Exports\ExportShift;
use App\Imports\ShiftImport;
use Maatwebsite\Excel\Facades\Excel;


class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $presensishift = Shift::all();
        // dd($presensishift); // Dump data menggunakan dd()
        // atau
        // var_dump($presensishift); // Dump data menggunakan var_dump()
        return view('presensishift.index', compact('presensishift'));
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
        $day = ['sunday',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday'];
        $presensishift = DB::table('presensis_shift')->get();
        $schools = DB::table('schools')->get();
        return view('presensishift.create', compact('presensishift','day', 'schools'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'nama_shift' => 'required',
        //     'school_id' => 'required|array'
        // ]);

        $db =  new Shift;
        $db->shift_name = $request->nama_shift;
        $db->school_id = $request->school_id;

        $db->save();
        // Redirect to index
        return redirect()->route('presensishift.index')->with(['message' => 'Data Berhasil Diupdate!']);
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
    public function edit($shift_id)
    {
        $school = DB::table('schools')->get();
        $shift = Shift::findOrFail($shift_id);
        return view('presensishift.edit', compact('shift','school','shift_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $shift_id)
    {
        $validatedData = $request->validate([
            'school_id' => 'required|min:2',
            'shift_name' => 'required|min:2',
        ]);

        $shift = \App\Models\Shift::findOrFail($shift_id);

        $shift->shift_name = $request->input('shift_name');
        $shift->school_id = $request->input('school');
        $shift->save();

        // Redirect to index
        return redirect()->route('presensishift.index')->with(['message' => 'Data Berhasil Diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shift = Shift::findOrFail($id);
        $shift->delete();

        if ($shift) {
            return redirect()
                ->route('presensishift.index')
                ->with('error','Data Deleted Successfully');
        } else {
            return redirect()
                ->route('presensishift.index')
                ->with('error','Data Deleted Successfully');
        }
    }

    public function import(Request $request)
    {
        Excel::import(new ShiftImport,
        $request->file('file')->store('files'));
        return Redirect::back()->with('message','Data import Successfully');
    }

    public function importView(Request $request)
    {
        Excel::import(new ImportShift,
        $request->file('file')->store('files'));
        return Redirect::back()->with('message','Data import Successfully');
    }

    public function exportshift()
    {
        return Excel::download(new ExportShift, 'shift.xlsx');
    }

    public function downloadfimport()
    {
        $filePath = public_path("formatshift.xlsx");
    	$headers = ['Content-Type: application/xlsx'];
    	$fileName = time().'.xlsx';

    	return response()->download($filePath, $fileName, $headers);
    }
}
