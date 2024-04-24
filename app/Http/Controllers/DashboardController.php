<?php

namespace App\Http\Controllers;

use App\Models\HolidayDate;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\School;
use App\Models\Presensi;
use App\Models\Pengumuman;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $user = User::count();
        $school = School::count();
        $presensi = Presensi::count();
        $pengumuman = Pengumuman::count();
        $libur = HolidayDate::count();

          // Hitung total presensi untuk setiap jenis status (hadir, tidak hadir, izin, tugas, sakit, cuti, terlambat, pulang cepat)
          $totalHadir = Presensi::where('ps_id', 1)->count();
          $totalTidakHadir = Presensi::where('ps_id', 2)->count();
          $totalIzin = Presensi::where('ps_id', 3)->count();
          $totalTugas = Presensi::where('ps_id', 6)->count();
          $totalSakit = Presensi::where('ps_id', 4)->count();
          $totalCuti = Presensi::where('ps_id', 5)->count();
          $totalTerlambat = Presensi::where('ps_id', 7)->count();
          $totalPulangCepat = Presensi::where('ps_id', 8)->count();

        // Hitung jumlah terlambat (gagal masuk tepat waktu) dan jumlah tepat waktu
        //   $jumlahTerlambat = Presensi::where('masuk', '>', DB::raw('presensis_hour.ph_time_start'))->count();
        //   $jumlahTepatWaktu = Presensi::where('masuk', '<=', DB::raw('presensis_hour.ph_time_start'))->count();

          // Hitung persentase kehadiran
          $totalPresensi = Presensi::count();
          $persentaseHadir = ($totalHadir / $totalPresensi) * 100;

          // Pass data ke tampilan (dashboard.blade.php)


        return view('dashboard', compact('user','school','presensi','libur',  'totalHadir',
        'totalTidakHadir',
        'totalIzin',
        'totalTugas',
        'totalSakit',
        'totalCuti',
        'totalTerlambat',
        'totalPulangCepat',
        // 'jumlahTerlambat',
        // 'jumlahTepatWaktu',
        'persentaseHadir'));
    }

     public function index()
    {
        //
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
