<?php

namespace App\Http\Controllers;

use App\Exports\ExportHoliday;
use App\Imports\HolidayDateImport;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Ixudra\Curl\Facades\Curl;
use App\Models\HolidayDate;
use Redirect;
use Maatwebsite\Excel\Facades\Excel;


class HolidaydateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     #jetstream #laravel #php #webdev



     public function index()
     {
        $presensiholiday = HolidayDate::all();
         return view('holidaydate.index', [
             'presensiholiday' => $presensiholiday
         ]);
     }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('holidaydate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
    {
    //     $this->validate($request, [
    //         'holiday_name' => 'required',
    //         'holiday_desc' => 'required',
    //         'holiday_type' => 'required',
    //         'holiday_status' => 'required',
    //     ]);

        $data = [
            'holiday_name' => $request->holiday_name,
            'holiday_desc' => $request->holiday_desc,
            'holiday_type' => $request->holiday_type,
            'holiday_status' => $request->holiday_status,
            'holiday_status' => 1,
        ];

        if ($request->holiday_type == 'date') {
            $this->validate($request, [
                'holiday_date' => 'required',
            ]);

            $data['holiday_date'] = $request->holiday_date;
        } elseif ($request->holiday_type == 'day') {
            $this->validate($request, [
                'holiday_day' => 'required',
            ]);

            $data['holiday_day'] = $request->holiday_day;
        }

        HolidayDate::create($data);


        return redirect()->action('App\Http\Controllers\HolidaydateController@index')->with('message', 'Data added Successfully');
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
      $presensiholiday = HolidayDate::findOrFail($id);
      return view('holidaydate.edit', ['data' => $presensiholiday], ['id' => $id]);
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
        $this->validate($request, [
            'holiday_name' => 'required',
            'holiday_desc' => 'required',
            'holiday_date' => 'required',
            'holiday_day' => 'required',
            'holiday_type' => 'required',
            'holiday_status' => 'required',
        ]);

        $holidayDate = HolidayDate::findOrFail($id);
        $holidayDate->update([
            'holiday_name' => $request->holiday_name,
            'holiday_desc' => $request->holiday_desc,
            'holiday_date' => $request->holiday_date,
            'holiday_day' => $request->holiday_day,
            'holiday_type' => $request->holiday_type,
            'holiday_status' => $request->holiday_status,
        ]);

        return redirect()->action('App\Http\Controllers\HolidaydateController@index')
            ->with('message', 'Data updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $presensiholiday = HolidayDate::findOrFail($id);
        $presensiholiday->delete();

        if ($presensiholiday) {
            return redirect()
                ->route('presensiholiday')
                ->with('error','Data Deleted Successfully');
        } else {
            return redirect()
                ->route('presensiholiday')
                ->with('error','Data Deleted Successfully');
        }
    }

    public function import(Request $request)
    {
        Excel::import(new HolidayDateImport,
        $request->file('file')->store('files'));
        return Redirect::back()->with('message','Data import Successfully');
    }

    public function importView(Request $request)
    {
        Excel::import(new ImportSchool,
        $request->file('file')->store('files'));
        return Redirect::back()->with('message','Data import Successfully');
    }

    public function exportholidays()
    {
        return Excel::download(new ExportHoliday, 'holidaydate.xlsx');
    }

    public function downloadfimport()
    {
        $filePath = public_path("formatholidays.xlsx");
    	$headers = ['Content-Type: application/xlsx'];
    	$fileName = time().'.xlsx';

    	return response()->download($filePath, $fileName, $headers);
    }
}
