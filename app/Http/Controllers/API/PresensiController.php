<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginSessionController;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\PresensiHour;
use App\Models\User;
use App\Models\School;
use App\Models\ApiBerita;
use App\Models\Event;
use App\Models\HolidayDate;
use App\Models\PresensiDetail;
use App\Models\Galery;
use Illuminate\Support\Facades\Auth;
use App\Models\PresensiHourDay;
use App\Models\LoginSession;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Broadcast;
use stdClass;

date_default_timezone_set("Asia/Kuala_Lumpur");

class PresensiController extends Controller
{
    function getPresensis()
    {
        $presensis = Presensi::where('user_id', Auth::user()->id)->get();
        foreach ($presensis as $item) {
            if ($item->tanggal == date('Y-m-d')) {
                $item->is_hari_ini = true;
            } else {
                $item->is_hari_ini = false;
            }
            $datetime = Carbon::parse($item->tanggal)->locale('id');
            $masuk = Carbon::parse($item->masuk)->locale('id');
            $pulang = Carbon::parse($item->pulang)->locale('id');

            $datetime->settings(['formatFunction' => 'translatedFormat']);
            $masuk->settings(['formatFunction' => 'translatedFormat']);
            $pulang->settings(['formatFunction' => 'translatedFormat']);

            $item->tanggal = $datetime->format('l, j F Y');
            $item->masuk = $masuk->format('H:i');
            $item->pulang = $pulang->format('H:i');
        }
        return response()->json([
            'success' => true,
            'data' => $presensis,
            'message' => 'Sukses menampilkan data'
        ]);
    }


    function masukPresensi(Request $request)
    {
        // Ambil tanggal saat ini
        $tanggalSekarang = Carbon::now()->format('Y-m-d');
        // Ambil daftar tanggal libur dari tabel holidays
        $tanggalLibur = HolidayDate::pluck('holiday_name', 'holiday_date')->toArray();
        // Tambahkan hari Minggu ke dalam daftar tanggal libur
        $tanggalLibur[Carbon::now()->startOfWeek()->addDays(6)->format('Y-m-d')] = 'Hari Minggu';
        // Periksa apakah tanggal saat ini merupakan tanggal libur atau hari Minggu
        if (array_key_exists($tanggalSekarang, $tanggalLibur) || Carbon::now()->isSunday()) {
            // Jika ya, ambil deskripsi hari libur
            $deskripsiHariLibur = isset($tanggalLibur[$tanggalSekarang]) ? $tanggalLibur[$tanggalSekarang] : 'Hari Libur';

            return response()->json([
                'success' => false,
                'message' => $deskripsiHariLibur,
            ], 400);
        }
        // Cek apakah sudah ada absensi yang terkait pada hari ini
        $user = Auth::user();
        $phId = $request->ph_id;
        $absensiMasuk = Presensi::where('user_id', $user->id)
            ->where('ph_id', $phId)
            ->whereDate('tanggal', $tanggalSekarang)
            ->first();

        if ($absensiMasuk) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah melakukan absen ' . $phId,
            ], 400);
        }

        $presensi = Presensi::whereDate('tanggal', '=', date('Y-m-d'))
            ->where('user_id', Auth::user()->id)
            ->where("ph_id", $request->ph_id)
            ->first();

        if ($presensi !== null) {
            // Jika data absensi sudah ada, maka melakukan return data tersebut
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah melakukan absen',
            ], 400);
        } else {
            $presensi = Presensi::create([
                'user_id' => Auth::user()->id,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'tanggal' => date('Y-m-d'),
                'masuk' => date('H:i:s'),
                'ph_id' => $request->ph_id,
                'ps_id' => $request->ps_id,
            ]);
            $presensihourday = PresensiHourDay::where('ph_id', $request->ph_id)->first();
            $batasTerlambat = Carbon::parse($presensihourday->ph_time_end);
            $waktuMasuk = Carbon::now();
            $lateDuration = $waktuMasuk->diffInSeconds($batasTerlambat, false); // Durasi terlambat dalam detik
            $pdPotonganTpp = 1.5;
            $presensiDetail = PresensiDetail::create([
                'presensi_id' => $presensi->id,
                'pd_time' => date('H:i:s'),
                'pd_lat' => $request->latitude,
                'pd_lng' => $request->longitude,
                'ps_id' => $request->ps_id,
                'ph_id' => $request->ph_id,
                'pd_desc' => $request->pd_desc,
                'pd_is_late' => $waktuMasuk > $batasTerlambat ? 1 : 0,
                'pd_late_length' => $waktuMasuk > $batasTerlambat ? $lateDuration : 0,
                'pd_potongan_tpp' => $pdPotonganTpp,
            ]);
            return response()->json([
                'success' => true,
                'data' => [
                    'presensi' => $presensi,
                    'presensi_detail' => $presensiDetail,
                ],
                'message' => '200, Sukses simpan',
            ]);
        }
    }

    public function holidays()
    {
        // Ambil tanggal saat ini
        $tanggalSekarang = Carbon::now()->format('Y-m-d');
        // Ambil daftar tanggal libur dari tabel holidays
        $tanggalLibur = HolidayDate::pluck('holiday_name', 'holiday_date')->toArray();
        // Tambahkan hari Minggu ke dalam daftar tanggal libur
        $tanggalLibur[Carbon::now()->startOfWeek()->addDays(6)->format('Y-m-d')] = 'Hari Minggu';
        // Periksa apakah tanggal saat ini merupakan tanggal libur atau hari Minggu
        if (array_key_exists($tanggalSekarang, $tanggalLibur) || Carbon::now()->isSunday()) {
            // Jika ya, ambil deskripsi hari libur
            $deskripsiHariLibur = isset($tanggalLibur[$tanggalSekarang]) ? $tanggalLibur[$tanggalSekarang] : 'Hari Libur';
            return Response::json([
                'success' => false,
                'message' => $deskripsiHariLibur,
            ], 400);
        }
        // Jika bukan tanggal libur atau hari Minggu
        return Response::json([
            'success' => false,
            'message' => 'Bukan Hari Libur',
        ], 200);
    }


    function masukPresensiv2(Request $request)
    {
        // Ambil tanggal saat ini
        $tanggalSekarang = Carbon::now()->format('Y-m-d');
        // Ambil daftar tanggal libur dari tabel holidays
        $tanggalLibur = HolidayDate::pluck('holiday_name', 'holiday_date')->toArray();
        // Tambahkan hari Minggu ke dalam daftar tanggal libur
        $tanggalLibur[Carbon::now()->startOfWeek()->addDays(6)->format('Y-m-d')] = 'Hari Minggu';
        // Periksa apakah tanggal saat ini merupakan tanggal libur atau hari Minggu
        if (array_key_exists($tanggalSekarang, $tanggalLibur) || Carbon::now()->isSunday()) {
            // Jika ya, ambil deskripsi hari libur
            $deskripsiHariLibur = isset($tanggalLibur[$tanggalSekarang]) ? $tanggalLibur[$tanggalSekarang] : 'Hari Libur';
            return response()->json([
                'success' => false,
                'message' => $deskripsiHariLibur,
            ], 400);
        }
        // Cek apakah sudah melakukan presensi masuk (ph_id = 1)
        $presensiMasuk = Presensi::whereDate('tanggal', '=', date('Y-m-d'))
            ->where('user_id', Auth::user()->id)
            ->where("ph_id", 1)
            ->first();
        if (!$presensiMasuk) {
            // Jika belum melakukan presensi masuk, kembalikan pesan error
            return response()->json([
                'success' => false,
                'message' => 'Anda belum melakukan presensi masuk',
            ], 400);
        }
        // Melakukan presensi pulang
        $presensiPulang = Presensi::whereDate('tanggal', '=', date('Y-m-d'))
            ->where('user_id', Auth::user()->id)
            ->where("ph_id", 2)
            ->first();
        if ($presensiPulang) {
            // Jika sudah melakukan presensi pulang sebelumnya, kembalikan data presensi
            return response()->json([
                'success' => true,
                'data' => $presensiPulang,
                'message' => 'Presensi pulang sebelumnya sudah tersimpan',
            ]);
        }
        // Melakukan proses presensi pulang
        $presensi = Presensi::create([
            'user_id' => Auth::user()->id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'tanggal' => date('Y-m-d'),
            'masuk' => date('H:i:s'),
            'ph_id' => $request->ph_id,
            'ps_id' => $request->ps_id,
        ]);
        return response()->json([
            'success' => true,
            'data' => $presensi,
            'message' => 'Presensi pulang berhasil disimpan',
        ])->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
    }


    public function GetUsers()
    {
        $users = User::all();
        return response()->json([
            'success' => true,
            'data' => $users,
            'message' => 'Sukses simpan'
        ]);
    }

    public function Event()
    {
        $event = Event::all();
        return response()->json([
            'success' => true,
            'data' => $event,
            'message' => 'Sukses simpan'
        ]);
    }

    public function laporanDetail()
{
    // Mendapatkan informasi pengguna yang sedang login
    $user = Auth::user(); // Pastikan Anda telah mengimpor 'use Illuminate\Support\Facades\Auth;'
    // Mendapatkan tanggal awal dan akhir bulan saat ini
    $tanggalAwalBulan = Carbon::now()->startOfMonth()->toDateString();
    $tanggalAkhirBulan = Carbon::now()->endOfMonth()->toDateString();
    // Mendapatkan daftar tanggal libur dari tabel holidays
    $tanggalLibur = HolidayDate::pluck('holiday_name', 'holiday_date')->toArray();
    // Menyaring data presensi berdasarkan ID pengguna yang saat ini diautentikasi
    $presensiDetails = PresensiHourDay::select(
            'tanggal',
            'masuk',
            'pulang',
            'pd_potongan_tpp' // Menambahkan kolom potongan_tpp
        )
        ->where('user_id', $user->id) // Menyaring berdasarkan ID pengguna yang diautentikasi
        ->whereBetween('tanggal', [$tanggalAwalBulan, $tanggalAkhirBulan])
        ->orderBy('tanggal')
        ->get();

    // Menandai hari libur dalam respons API
    foreach ($presensiDetails as $presensi) {
        $tanggal = $presensi->tanggal;
        if (array_key_exists($tanggal, $tanggalLibur)) {
            // Jika tanggal presensi adalah hari libur, tambahkan flag hari libur
            $presensi->is_hari_libur = true;
            $presensi->deskripsi_hari_libur = $tanggalLibur[$tanggal];
        } else {
            $presensi->is_hari_libur = false;
            $presensi->deskripsi_hari_libur = null;
        }
    }

    return response()->json([
        'success' => true,
        'data' => $presensiDetails,
        'message' => 'Sukses menampilkan detail presensi harian dari tanggal 1 sampai akhir bulan'
    ]);
}


    public function Broadcast()
    {
        $broadcast = Broadcast::all();
        return response()->json([
            'success' => true,
            'data' => $broadcast,
            'message' => 'Sukses simpan'
        ]);
    }

    public function LoginSession(Request $request)
    {
        $loginsession = LoginSession::create([
            'app_id' => $request->app_id,
            'user_id' => $request->user_id,
            'ls_key' => $request->ls_key,
            'ls_firebase_reg_id' => $request->ls_firebase_reg_id,
            'ls_device' => $request->ls_device,
            'ls_device_version' => $request->ls_device_version,
            'ls_os_version' => $request->ls_os_version,
            'ls_carrier' => $request->ls_carrier,
            'ls_channel' => $request->ls_channel,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
        ]);

        return response()->json([
            'success' => true,
            'data' => $loginsession,
            'message' => 'Sukses simpan'
        ]);
    }

    public function GetSekolah()
    {
        $data = School::all();
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Sukses menampilkan data Sekolah'
        ]);
    }

    public function berita()
    {
        $data = ApiBerita::all();
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Sukses menampilkan data Sekolah'
        ]);
    }

    public function presensiHour()
    {
        $presensihour = PresensiHour::all();
        return response()->json([
            'success' => true,
            'data' => $presensihour,
            'message' => '200, Sukses Menampilkan data'
        ]);
    }

    public function galery()
    {
        $galery = Galery::all();
        foreach ($galery as $item) {
            $item->image = asset('storage/' . $item->image);
        }
        return response()->json($galery);
    }

    public function laporan(Request $request)
    {
        // Mendapatkan informasi pengguna yang sedang login
        $user = Auth::user(); // Pastikan Anda telah mengimpor 'use Illuminate\Support\Facades\Auth;'
        // Menyaring data laporan berdasarkan ID pengguna yang saat ini diautentikasi
        $presensis = Presensi::select(
            'users.name',
            DB::raw('MONTH(presensis.created_at) AS bulan'),
            DB::raw('YEAR(presensis.created_at) AS tahun'),
            DB::raw('COUNT(CASE WHEN presensis.ps_id = 1 THEN 1 END) AS hadir'),
            DB::raw('COUNT(CASE WHEN presensis.ps_id = 2 THEN 1 END) AS tidak_hadir'),
            DB::raw('COUNT(CASE WHEN presensis.ps_id = 3 THEN 1 END) AS izin'),
            DB::raw('COUNT(CASE WHEN presensis.ps_id = 4 THEN 1 END) AS sakit'),
            DB::raw('COUNT(CASE WHEN presensis.ps_id = 5 THEN 1 END) AS cuti'),
            DB::raw('COUNT(CASE WHEN presensis.ps_id = 6 THEN 1 END) AS tugas'),
            DB::raw('COUNT(CASE WHEN presensis.ps_id = 7 THEN 1 END) AS izin_terlambat'),
            DB::raw('COUNT(CASE WHEN presensis.ps_id = 8 THEN 1 END) AS izin_pulang_cepat'))
        ->join('users', 'presensis.user_id', '=', 'users.id')
        ->where('users.id', $user->id) // Menyaring berdasarkan ID pengguna yang diautentikasi
        ->groupBy('users.name', 'bulan', 'tahun')
        ->get();
        return response()->json([
            'success' => true,
            'data' => $presensis,
            'message' => '200, Sukses Menampilkan data'
        ]);
    }

}
