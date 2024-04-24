<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportSchool;
use App\Exports\ExportSchool;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $school = School::all();
        return view('school.index', [
            'school' => $school
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('school.create-school');
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
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'radius' => 'required',
        ]);
        School::create([
            'name' => $request->name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'radius' => $request->radius,
        ]);
        // dd($request->all());
        return redirect()->action('App\Http\Controllers\SchoolController@index')->with('message','Data added Successfully');
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
        $school = School::findOrFail($id);
        return view('school.school-edit', compact('school'));
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
        $validatedData = $request->validate([
            'name' => 'required|min:2',
            'latitude' => 'required|min:2',
            'longitude' =>'required|min:2',
            'radius' => 'required'
        ]);

        $school = \App\Models\School::findOrFail($id);

        $school->name = $request->input('name');
        $school->latitude = $request->input('latitude');
        $school->longitude = $request->input('longitude');
        $school->radius = $request->input('radius');

        $school->save();

        // Redirect to index
        return redirect()->route('school.index')->with(['message' => 'Data Berhasil Diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $school = School::findOrFail($id);
        $school->delete();

        if ($school) {
            return redirect()
                ->route('school.index')
                ->with('error','Data Deleted Successfully');
        } else {
            return redirect()
                ->route('school.index')
                ->with('error','Data Deleted Successfully');
        }
    }

    public function import(Request $request)
    {
        Excel::import(new ImportSchool,
        $request->file('file')->store('files'));
        return Redirect::back()->with('message','Data import Successfully');
    }

    public function importView(Request $request)
    {
        Excel::import(new ImportSchool,
        $request->file('file')->store('files'));
        return Redirect::back()->with('message','Data import Successfully');
    }

    public function exportSchools()
    {
        return Excel::download(new ExportSchool, 'schools.xlsx');
    }

    public function downloadfimport()
    {
        $filePath = public_path("formatsekolah.xlsx");
    	$headers = ['Content-Type: application/xlsx'];
    	$fileName = time().'.xlsx';

    	return response()->download($filePath, $fileName, $headers);
    }
}
