<?php

namespace App\Http\Controllers;

use App\Models\PresensiHourDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\School;
use App\Models\Shift;
use App\Models\PresensiHour;
use Maatwebsite\Excel\Facades\Excel;
// use App\Exports\exportpresensihourday;
use App\Imports\PresensiHourdayImport;

class PresensiHourDayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $presensihourday = Presensihourday::with('presensihour', 'shift', 'school')->get();

        return view('presensihourday.index', compact('presensihourday'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $day = ['sunday',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday'];

        $school = DB::table('schools')->get();
        $presensihour = DB::table('presensis_hour')->get();
        $shift = DB::table('presensis_shift')->get();

        return view('presensihourday.create',compact('day', 'school', 'shift','presensihour'));
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
        //     'hari' => 'required',
        //     'shift' => 'required',
        //     'jam_absen' => 'required',
        //     'school' => 'required',
        //     'ph_time_start' => 'required',
        //     'ph_time_end' => 'required',
        // ]);
        $db =  new PresensiHourDay;
        $db->ph_day = $request->hari;
        $db->shift_id = $request->shift;
        $db->school_id = $request->school;
        $db->ph_id = $request->jam_absen;
        $db->ph_time_start = $request->ph_time_start;
        $db->ph_time_end = $request->ph_time_end;
        // $db->save();
        // dd($request->all());

        PresensiHourDay::create([
            'ph_day' => $request->hari,
            'shift_id' => $request->shift,
            'school_id' => $request->school,
            'ph_id' => $request->jam_absen,
            'ph_time_start' => $request->ph_time_start,
            'ph_time_end' => $request->ph_time_end,
        ]);
        // dd($request->all());
        // dd($request->all());
        // Redirect to index
        return redirect()->route('presensihourday.index')->with(['message' => 'Data Berhasil Diupdate!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PresensiHourDay  $presensiHourDay
     * @return \Illuminate\Http\Response
     */
    public function show(PresensiHourDay $presensiHourDay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PresensiHourDay  $presensiHourDay
     * @return \Illuminate\Http\Response
     */
    public function edit($phd_id)
    {
        $day = ['sunday',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday'];
        $school = DB::table('schools')->get();
        $presensihour = DB::table('presensis_hour')->get();
        $shift = DB::table('presensis_shift')->get();
        $presensihourday = PresensiHourDay::findOrFail($phd_id);
        $data = Presensihourday::findOrFail($phd_id);
        return view('presensihourday.edit', compact('presensihourday','day','school','presensihour','shift','data','phd_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PresensiHourDay  $presensiHourDay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $phd_id)
    {
        // Validasi input form jika diperlukan
        // $this->validate($request, [
        //     'hari' => 'required',
        //     'shift' => 'required',
        //     'jam_absen' => 'required',
        //     'school' => 'required',
        //     'ph_time_start' => 'required',
        //     'ph_time_end' => 'required',
        // ]);
        // Cari data yang akan diupdate
        $db = PresensiHourDay::findOrFail($phd_id);
        // Update data dengan nilai baru
        $db->ph_day = $request->hari;
        $db->shift_id = $request->shift;
        $db->school_id = $request->school;
        $db->ph_id = $request->jam_absen;
        $db->ph_time_start = $request->ph_time_start;
        $db->ph_time_end = $request->ph_time_end;
        $db->save();
        // Redirect to index
        return redirect()->route('presensihourday.index')->with(['message' => 'Data Berhasil Diupdate!']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PresensiHourDay  $presensiHourDay
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $presensihourday = PresensiHourDay::findOrFail($id);
        $presensihourday->delete();

        if ($presensihourday) {
            return redirect()
                ->route('presensihourday.index')
                ->with('error','Data Deleted Successfully');
        } else {
            return redirect()
                ->route('presensihourday.index')
                ->with('error','Data Deleted Successfully');
        }
    }

    public function import(Request $request)
    {
        Excel::import(new PresensiHourDayImport,
        $request->file('file')->store('files'));
        return Redirect::back()->with('message','Data import Successfully');
    }

    public function importView(Request $request)
    {
        Excel::import(new ImportPresensihourday,
        $request->file('file')->store('files'));
        return Redirect::back()->with('message','Data import Successfully');
    }

    public function exporthourdays()
    {
        return Excel::download(new ExportPresensiHourday, 'presensihourday.xlsx');
    }

    public function downloadfimport()
    {
        $filePath = public_path("formatpresensihourday.xlsx");
    	$headers = ['Content-Type: application/xlsx'];
    	$fileName = time().'.xlsx';

    	return response()->download($filePath, $fileName, $headers);
    }
}
