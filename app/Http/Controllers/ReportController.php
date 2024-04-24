<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\PresensiHour;
use App\Models\PresensiStatus;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\HolidayDate;
use Auth;
use PDF;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index(Request $request)
     {
         if (isset($request->year) && isset($request->month)) {
             $presensis2 = Presensi::select(
                 'presensis.*',
                 'schools.name',
                 'users.name',
                 'users.nip',
                 DB::raw('COUNT(*)/2 as total'),
                 DB::raw('COUNT(IF(ps_id="1",1,NULL)) as hadir'),
                 DB::raw('COUNT(IF(ps_id="2",1,NULL)) as tidak_hadir'),
                 DB::raw('COUNT(IF(ps_id="3",1,NULL)) as izin'),
                 DB::raw('COUNT(IF(ps_id="4",1,NULL)) as sakit'),
                 DB::raw('COUNT(IF(ps_id="5",1,NULL)) as cuti'),
                 DB::raw('COUNT(IF(ps_id="6",1,NULL)) as tugas'),
                 DB::raw('COUNT(IF(ps_id="7",1,NULL)) as terlambat'),
                 DB::raw('COUNT(IF(ps_id="8",1,NULL)) as pulang_cepat'),
                 DB::raw('COUNT(IF(ps_id="8",1,NULL)) as total_pulangcepat'),
                 DB::raw('COUNT(CASE WHEN (presensis.masuk > presensis_hour.ph_time_start) THEN 1 ELSE NULL END) AS jumlah_terlambat'),
                 DB::raw('COUNT(CASE WHEN (presensis.masuk <= presensis_hour.ph_time_start) THEN 1 ELSE NULL END) AS jumlah_tepat_waktu'),
                //  DB::raw('COUNT(CASE WHEN (presensis.pulang < presensis_hour.ph_time_end) THEN 1 ELSE NULL END) AS jumlah_pulang_cepat')
             )->with('user')
                 ->whereMonth('presensis.tanggal', $request->month)
                 ->whereYear('presensis.tanggal', $request->year)
                 ->join('presensis_hour', 'presensis.ph_id', '=', 'presensis_hour.id')
                 ->join('users', 'presensis.user_id', '=', 'users.id')
                 ->join('schools', 'users.school_id', '=', 'schools.id')
                 ->where('schools.id', $request->school)
                 ->whereIn('ps_id', ['1', '2', '3', '4', '5', '6', '7', '8'])
                 ->groupBy('users.name')
                 ->orderBy('presensis.tanggal') // Mengurutkan berdasarkan tanggal
                 ->get();

             $schools = School::select('name', 'id')->get();
             return view('report.perbulan', [
                 'schools' => $schools,
                 'year' => $request->year,
                 'month' => $request->month,
                 'presensis' => $presensis2
             ]);
         } else {
             $schools = School::select('name', 'id')->get();
             return view('report.perbulan', compact('schools'));
         }
     }
    // public function index(Request $request)
    // {
    //     if (isset($request->year) && isset($request->month)) {
    //         $presensis2 = Presensi::select(
    //             'presensis.*',
    //             'schools.name',
    //             'users.name',
    //             'users.nip',
    //             DB::raw('COUNT(*)/2 as total'),
    //             DB::raw('COUNT(IF(ps_id="1",1,NULL)) as hadir'),
    //             DB::raw('COUNT(IF(ps_id="2",1,NULL)) as tidak_hadir'),
    //             DB::raw('COUNT(IF(ps_id="3",1,NULL)) as izin'),
    //             DB::raw('COUNT(IF(ps_id="4",1,NULL)) as sakit'),
    //             DB::raw('COUNT(IF(ps_id="5",1,NULL)) as cuti'),
    //             DB::raw('COUNT(IF(ps_id="6",1,NULL)) as tugas'),
    //             DB::raw('COUNT(IF(ps_id="7",1,NULL)) as terlambat'),
    //             DB::raw('COUNT(IF(ps_id="8",1,NULL)) as pulang_cepat'),
    //             DB::raw('COUNT(IF(ps_id="8",1,NULL)) as total_pulangcepat'),
    //             DB::raw('COUNT(CASE WHEN (presensis.masuk > presensis_hour.ph_time_start) THEN 1 ELSE NULL END) AS jumlah_terlambat'),
    //             DB::raw('COUNT(CASE WHEN (presensis.masuk <= presensis_hour.ph_time_start) THEN 1 ELSE NULL END) AS jumlah_tepat_waktu'),
    //             DB::raw('COUNT(CASE WHEN (presensis.ph_id = 2 < presensis_hour.ph_time_end) THEN 1 ELSE NULL END) AS jumlah_pulang_cepat')

    //         )->with('user')
    //             ->whereMonth('presensis.tanggal', $request->month)
    //             ->whereYear('presensis.tanggal', $request->year)
    //             ->join('presensis_hour', 'presensis.ph_id', '=', 'presensis_hour.id')
    //             ->join('users', 'presensis.user_id', '=', 'users.id')
    //             ->join('schools', 'users.school_id', '=', 'schools.id')
    //             ->where('schools.id', $request->school)
    //             ->whereIn('ps_id', ['1', '2', '3', '4', '5', '6', '7', '8'])
    //             ->groupBy('users.name')
    //             ->get();
    //         $schools = School::select('name', 'id')->get();
    //         return view('report.perbulan', [
    //             'schools' => $schools,
    //             'year' => $request->year,
    //             'month' => $request->month,
    //             'presensis' => $presensis2
    //         ]);
    //     } else {
    //         $schools = School::select('name', 'id')->get();
    //         return view('report.perbulan', compact('schools'));
    //     }
    // }
    public function perhari(Request $request)
    {

        if (isset($request->date)) {
            $presensis2 = Presensi::with(['user'])->select(
                'presensis.*',
                'schools.name',
                'users.name',
                'users.nip',
                DB::raw('COUNT(*)/2 as total'),
                DB::raw('COUNT(IF(ps_id="1",1,NULL)) as hadir'),
                DB::raw('COUNT(IF(ps_id="2",1,NULL)) as tidak_hadir'),
                DB::raw('COUNT(IF(ps_id="3",1,NULL)) as izin'),
                DB::raw('COUNT(IF(ps_id="4",1,NULL)) as sakit'),
                DB::raw('COUNT(IF(ps_id="5",1,NULL)) as cuti'),
                DB::raw('COUNT(IF(ps_id="6",1,NULL)) as tugas'),
                DB::raw('COUNT(IF(ps_id="7",1,NULL)) as terlambat'),
                DB::raw('COUNT(IF(ps_id="8",1,NULL)) as pulang_cepat'),
                DB::raw('COUNT(IF(ps_id="8",1,NULL)) as total_pulangcepat'),
                DB::raw('COUNT(CASE WHEN (presensis.masuk > presensis_hour.ph_time_start) THEN 1 ELSE NULL END) AS jumlah_terlambat'),
                DB::raw('COUNT(CASE WHEN (presensis.masuk <= presensis_hour.ph_time_start) THEN 1 ELSE NULL END) AS jumlah_tepat_waktu'),
                // DB::raw('COUNT(CASE WHEN (presensis.pulang < presensis_hour.ph_time_end) THEN 1 ELSE NULL END) AS jumlah_pulang_cepat')
            )
                ->where('presensis.tanggal', $request->date)
                ->join('presensis_hour', 'presensis.ph_id', '=', 'presensis_hour.id')
                ->join('users', 'presensis.user_id', '=', 'users.id')
                ->join('schools', 'users.school_id', '=', 'schools.id')
                ->where('schools.id', $request->school)
                ->whereIn('ps_id', ['1', '2', '3', '4', '5', '6', '7', '8'])
                ->groupBy('users.name')
                ->get();
            $schools = School::select('name', 'id')->get();
            return view('report.perhari', [
                'schools' => $schools,
                'date' => $request->date,
                'presensis' => $presensis2
            ]);
        } else {
            $schools = School::with('user')->select('name', 'id')->get();
            return view('report.perhari', compact('schools'));
        }
    }

    public function getStatusPresensi($ps_id) {
        switch ($ps_id) {
            case 1:
                return 'Hadir';
            case 2:
                return 'Tidak Hadir';
            case 3:
                return 'Izin';
            case 4:
                return 'Sakit';
            case 5:
                return 'Cuti';
            case 6:
                return 'Tugas';
            case 7:
                return 'Izin Terlambat';
            case 8:
                return 'Izin Pulang Cepat';
        }
    }


    public function detail(Request $request, $id)
    {
        $presensiholiday = HolidayDate::get();
        $presensi = null;
        if ($request->date) {
            $presensi = Presensi::with('user')
                ->where('tanggal', $request->date)
                ->where('user_id', $id)->get();
        } else {
            $year = $request->year;
            $month = $request->month;
            $startOfMonth = Carbon::createFromDate($year, $month, 1);
            $endOfMonth = Carbon::createFromDate($year, $month, 1)->endOfMonth();

            $presensi = Presensi::with('user')
                ->where('user_id', $id)
                ->whereBetween('tanggal', [$startOfMonth, $endOfMonth])
                ->get();
        }

        $year = $request->year;
        $month = $request->month;

        return view('report.detail', compact('presensiholiday','presensi', 'year', 'month'));
    }


    public function report_pdf(Request $request)
    {
        if (isset($request->year) && isset($request->month)) {
            $presensis2 = Presensi::select(
                'presensis.*',
                'schools.name',
                'users.name',
                'users.nip',
                DB::raw('COUNT(*)/2 as total'),
                DB::raw('COUNT(IF(ps_id="1",1,NULL)) as hadir'),
                DB::raw('COUNT(IF(ps_id="2",1,NULL)) as tidak_hadir'),
                DB::raw('COUNT(IF(ps_id="3",1,NULL)) as izin'),
                DB::raw('COUNT(IF(ps_id="4",1,NULL)) as sakit'),
                DB::raw('COUNT(IF(ps_id="5",1,NULL)) as cuti'),
                DB::raw('COUNT(IF(ps_id="6",1,NULL)) as tugas'),
                DB::raw('COUNT(IF(ps_id="7",1,NULL)) as terlambat'),
                DB::raw('COUNT(IF(ps_id="8",1,NULL)) as pulang_cepat'),
                DB::raw('COUNT(IF(ps_id="8",1,NULL)) as total_pulangcepat'),
                DB::raw('COUNT(CASE WHEN (presensis.masuk > presensis_hour.ph_time_start) THEN 1 ELSE NULL END) AS jumlah_terlambat'),
                DB::raw('COUNT(CASE WHEN (presensis.masuk <= presensis_hour.ph_time_start) THEN 1 ELSE NULL END) AS jumlah_tepat_waktu'),
                // DB::raw('COUNT(CASE WHEN (presensis.pulang < presensis_hour.ph_time_end) THEN 1 ELSE NULL END) AS jumlah_pulang_cepat')
            )->with('user')
                ->whereMonth('presensis.tanggal', $request->month)
                ->whereYear('presensis.tanggal', $request->year)
                ->join('presensis_hour', 'presensis.ph_id', '=', 'presensis_hour.id')
                ->join('users', 'presensis.user_id', '=', 'users.id')
                ->join('schools', 'users.school_id', '=', 'schools.id')
                ->where('schools.id', $request->school)
                ->whereIn('ps_id', ['1', '2', '3', '4', '5', '6', '7', '8'])
                ->groupBy('users.name')
                ->get();

            $schools = School::select('name', 'id')->get();
            $pdf = PDF::loadview('report.reportperbulanpdf',[
                'schools' => $schools,
                'year' => $request->year,
                'month' => $request->month,
                'presensis' => $presensis2
            ])->setPaper('a4', 'landscape');
            // dd($request->all());
            return $pdf->stream('laporan-presensi-perbulan-pdf', compact('schools'));

        } else {
            $schools = School::select('name', 'id')->get();
            $pdf = PDF::loadview('report.reportperbulanpdf',[
                'schools' => $schools,
            ])->setPaper('a4', 'landscape');
            // dd($request->all());
            return $pdf->stream('laporan-presensi-perbulan-pdf', compact('schools'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }
}
