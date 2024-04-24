<?php

use Carbon\Carbon;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Str; {


function excelTimeToPhp($the_value)
    {
        $total = $the_value * 24; //multiply by the 24 hours
        $hours = floor($total); //Gets the natural number part
        $minute_fraction = $total - $hours; //Now has only the decimal part
        $minutes = round($minute_fraction * 60); //Get the number of minutes
        $minutes_whole = floor( $minutes );
        $seconds_fraction = $minutes - $minutes_whole;
        $seconds = $seconds_fraction * 60;

        $data = str_pad($hours, 2, 0,STR_PAD_LEFT) . ":" . str_pad($minutes, 2, 0, STR_PAD_LEFT) . ":" . str_pad($seconds, 2, 0, STR_PAD_LEFT);
        return $data;
    }

    function replaceArrayString($x)
    {
        $y = preg_replace("(\]|\[|'|\")", "", $x);
        return $y;
    }

    function my_upload_file($file, $path = "uploads", $withpath = false)
    {
        $ext = $file->getClientOriginalExtension();
        $filename = Str::random() . '.' . $ext;
        $file->move($path, $filename);
        if ($withpath) {
            return asset($path . "/" . $filename);
        } else {
            return $filename;
        }
    }

    function base64_to_image($data, $path)
    {
        list($type, $data) = explode(';', $data);
        list(, $data) = explode(',', $data);
        $data = base64_decode($data);

        $up = File::put(public_path($path), $data);

        return $up;
    }

    function if_empty($str, $out = "-")
    {
        if ($str == null) {
            return $out;
        }
        return $str;
    }

    function boolean_text($bool, $true = "aktif", $false = "tidak aktif")
    {
        if ($bool == true) {
            return $true;
        } else {
            return $false;
        }
    }

    function text_boolean($text, $true = "aktif", $false = "tidak aktif")
    {
        if ($text == $true) {
            return true;
        } else {
            return false;
        }
    }

    function getBulanFromDate($date, $year = false)
    {
        $dt = Carbon::parse($date);
        if ($year) {
            return bulan($dt->month) . ' ' . $dt->year;
        }
        return bulan($dt->month);
    }

    function responseJson($message, $data = null, $status = true, $text = 'success', $statusCode = 200)
    {
        return response(['status' => $status, 'text' => $text, 'message' => $message, 'data' => $data], $statusCode);
    }

    function waktu($timestamps)
    {
        $dt = Carbon::parse($timestamps);
        return $dt->hour . ":" . $dt->minute;
    }

    function tanggal_lengkap($timestamps, $tampilkan_hari = true, $tampilkan_waktu = false, $hanyaHari = false)
    {
        $dt = Carbon::parse($timestamps);
        $hari = $dt->dayOfWeek;
        if ($hari == 1) {
            $hari = 'Senin';
        } else if ($hari == 2) {
            $hari = 'Selasa';
        } else if ($hari == 3) {
            $hari = 'Rabu';
        } else if ($hari == 4) {
            $hari = 'Kamis';
        } else if ($hari == 5) {
            $hari = 'Jumat';
        } else if ($hari == 6) {
            $hari = 'Sabtu';
        } else {
            $hari = 'Minggu';
        }

        if ($hanyaHari) {
            return $hari;
        }

        if ($tampilkan_hari == false) {
            $hari = "";
        }

        $day = $dt->day;
        $month = $dt->month;

        if ($month == 1) {
            $bulan = 'januari';
        } else if ($month == 2) {
            $bulan = 'februari';
        } else if ($month == 3) {
            $bulan = 'maret';
        } else if ($month == 4) {
            $bulan = 'april';
        } else if ($month == 5) {
            $bulan = 'mei';
        } else if ($month == 6) {
            $bulan = 'juni';
        } else if ($month == 7) {
            $bulan = 'juli';
        } else if ($month == 8) {
            $bulan = 'agustus';
        } else if ($month == 9) {
            $bulan = 'september';
        } else if ($month == 10) {
            $bulan = 'oktober';
        } else if ($month == 11) {
            $bulan = 'november';
        } else if ($month == 12) {
            $bulan = 'desember';
        }

        $bulan = ucwords($bulan);

        $tahun = $dt->year;

        $waktu = $dt->format("H:i:s");

        if ($tampilkan_waktu) {
            $tanggal = "$hari $day $bulan $tahun $waktu";
        } else {
            $tanggal = "$hari $day $bulan $tahun";
        }

        return $tanggal;
    }

    function uang($angka, $tampilkanMataUang = true, $symbol = 'Rp.')
    {
        $hasil_rupiah = number_format($angka, 2, ',', '.');
        return $tampilkanMataUang ? $symbol . $hasil_rupiah : $hasil_rupiah;
    }

    function generate_links($name, $id, $links_additional = [])
    {
        $links = [
            'store' => route($name . ".store"),
            'show' => route($name . '.show', $id),
            'edit' => route($name . '.edit', $id),
            'update' => route($name . '.update', $id),
            'destroy' => route($name . '.destroy', $id),
        ];
        if (count($links_additional) > 0) {
            array_push($links, $links_additional);
        }
        return auth()->check() ? $links : [];
    }

    function generate_links_api($name, $id, $links_additional = [])
    {
        $links = [
            'store' => route($name . ".store"),
            'show' => route($name . '.show', $id),
            'update' => route($name . '.update', $id),
            'destroy' => route($name . '.destroy', $id),
        ];

        if (count($links_additional) > 0) {
            /*foreach($links_additional as $key => $link){
            array_merge($links, $link);
        }*/
            $links = array_merge($links, $links_additional);
        }

        return $links;
    }


    function max100($angka)
    {
        return $angka >= 100 ? 100 : $angka;
    }

    function toastrResponse($message = 'data berhasil ditambahkan', $text = 'success', $code = 200)
    {
        return response()->json(['status' => true, 'message' => $message, 'text' => $text], $code);
    }

    function namaWithGelar($pegawai)
    {
        $pegawai->pegawai_gelardepan == "-" || $pegawai->pegawai_gelardepan == null ? $awal = "" : $awal = $pegawai->pegawai_gelardepan . ", ";
        $pegawai->pegawai_gelarbelakang == "-" || $pegawai->pegawai_gelarbelakang == null ? $belakang = "" : $belakang = ' ,' . $pegawai->pegawai_gelarbelakang;

        return $awal . $pegawai->pegawai_nama . $belakang;
    }

    function getMonth($ym)
    {
        $date = explode('-', $ym);
        return $date[1];
    }

    function getYear($ym)
    {
        $date = explode('-', $ym);
        return $date[0];
    }

    function hari($hari)
    {
        if ($hari == 'monday') {
            $hari = 'Senin';
        } else if ($hari == 'tuesday') {
            $hari = 'Selasa';
        } else if ($hari == 'wednesday') {
            $hari = 'Rabu';
        } else if ($hari == 'thursday') {
            $hari = 'Kamis';
        } else if ($hari == 'friday') {
            $hari = 'Jumat';
        } else if ($hari == 'saturday') {
            $hari = 'Sabtu';
        } elseif ($hari == 'sunday') {
            $hari = 'Minggu';
        } else {
            $hari = '-';
        }
        return $hari;
    }

    function tanggal($timestamps, $separator = "/")
    {
        $dt = Carbon::parse($timestamps);

        if ($timestamps == '0000-00-00') {
            return '-';
        }
        $day = $dt->day;
        $bulan = $dt->month;
        $tahun = $dt->year;
        $tanggal = $day . $separator . $bulan . $separator . $tahun;
        return $tanggal;
    }

    function bulan($month)
    {
        if ($month == 1) {
            $bulan = 'januari';
        } else if ($month == 2) {
            $bulan = 'februari';
        } else if ($month == 3) {
            $bulan = 'maret';
        } else if ($month == 4) {
            $bulan = 'april';
        } else if ($month == 5) {
            $bulan = 'mei';
        } else if ($month == 6) {
            $bulan = 'juni';
        } else if ($month == 7) {
            $bulan = 'juli';
        } else if ($month == 8) {
            $bulan = 'agustus';
        } else if ($month == 9) {
            $bulan = 'september';
        } else if ($month == 10) {
            $bulan = 'oktober';
        } else if ($month == 11) {
            $bulan = 'november';
        } else if ($month == 12) {
            $bulan = 'desember';
        }

        return $bulan;
    }

    function tanggal_indo($timestamps)
    {
        $dt = Carbon::parse($timestamps);
        $hari = $dt->dayOfWeek;
        if ($hari == 1) {
            $hari = 'Senin';
        } else if ($hari == 2) {
            $hari = 'Selasa';
        } else if ($hari == 3) {
            $hari = 'Rabu';
        } else if ($hari == 4) {
            $hari = 'Kamis';
        } else if ($hari == 5) {
            $hari = 'Jumat';
        } else if ($hari == 6) {
            $hari = 'Sabtu';
        } else {
            $hari = 'Minggu';
        }
        $day = $dt->day;
        $bulan = $dt->month;
        $tahun = $dt->year;
        $tanggal = $hari . ', ' . $day . '-' . $bulan . '-' . $tahun;
        return $tanggal;
    }

    function tanggal_lahir($timestamps)
    {

        $dt = Carbon::parse($timestamps);

        $hari = $dt->dayOfWeek;
        if ($hari == 1) {
            $hari = 'Senin';
        } else if ($hari == 2) {
            $hari = 'Selasa';
        } else if ($hari == 3) {
            $hari = 'Rabu';
        } else if ($hari == 4) {
            $hari = 'Kamis';
        } else if ($hari == 5) {
            $hari = 'Jumat';
        } else if ($hari == 6) {
            $hari = 'Sabtu';
        } else {
            $hari = 'Minggu';
        }

        $month = $dt->month;
        if ($month == 1) {
            $month = 'Januari';
        } else if ($month == 2) {
            $month = 'Februari';
        } else if ($month == 3) {
            $month = 'Maret';
        } else if ($month == 4) {
            $month = 'April';
        } else if ($month == 5) {
            $month = 'Mei';
        } else if ($month == 6) {
            $month = 'Juni';
        } else if ($month == 7) {
            $month = 'Juli';
        } else if ($month == 8) {
            $month = 'Agustus';
        } else if ($month == 9) {
            $month = 'September';
        } else if ($month == 10) {
            $month = 'Oktober';
        } else if ($month == 11) {
            $month = 'November';
        } else if ($month == 12) {
            $month = 'Desember';
        }
        // $tanggal  = $dt->day;
        $tahun = $dt->year;
        $day = $dt->day;
        $tanggal = $hari . ', ' . $day . ' ' . $month . ' ' . $tahun;
        return $tanggal;
    }

    function getAge($born)
    {
        $dt = Carbon::parse($born);

        $year = $dt->year;
        $month = $dt->month;
        $day = $dt->day;

        $age = Carbon::createFromDate($year, $month, $day)->age;

        // dd($age);

        return $age;
    }

    function datepicke3($date)
    {
        $dt = explode('/', $date);
        return $datepicker = $dt[2] . '-' . $dt[0] . '-' . $dt[1];
    }

    function datepicker2($date)
    {
        $dt = explode('/', $date); //m-d-y
        return $datepicker = $dt[2] . '-' . $dt[1] . '-' . $dt[0];
    }

    function datepicker($date)
    {
        $dt = explode('-', $date); //m-d-y
        return $datepicker = $dt[2] . '-' . $dt[1] . '-' . $dt[0];
    }

    function getDayName($date)
    {
        $dt = Carbon::parse($date);
        $day = $dt->format('l');
        return strtolower($day);
    }

    function getDayOfMonth($month, $year)
    {

        $list = array();

        for ($d = 1; $d <= 31; $d++) {
            $time = mktime(12, 0, 0, $month, $d, $year);
            if (date('m', $time) == $month)
                $list[] = date('Y-m-d', $time);
        }

        return $list;
    }

    function getDateOfMonth($month, $year)
    {

        $list = array();

        for ($d = 1; $d <= 31; $d++) {
            $time = mktime(12, 0, 0, $month, $d, $year);
            if (date('m', $time) == $month)
                $list[] = date('d', $time);
        }

        return $list;
    }

    function getDatesOfMonth($month, $year)
    {
        $dt = Carbon::parse($year . '-' . $month);
        // dd($dt);+"date": "2017-11-01 00:00:00.000000"
        $daysInMonth = $dt->daysInMonth;
        for ($i = 1; $i < $daysInMonth; $i++) {
            $labels[] = $year . '-' . $month . '-' . $i;
        }
        // dd($labels);
        return $labels;
    }

    function adStatus($ad_time)
    {
        if ($ad_time == "00:00:00" || $ad_time == null) {
            return '-';
        }
        return $ad_time;
    }

    function rupiah($money)
    {
        return 'Rp.' . number_format($money);
    }

    function nip($nip, $batas = " ")
    {
        $nip = trim($nip, "-");
        $panjang = strlen($nip);

        if ($panjang == 18) {
            $sub[] = substr($nip, 0, 8); // tanggal lahir
            $sub[] = substr($nip, 8, 6); // tanggal pengangkatan
            $sub[] = substr($nip, 14, 1); // jenis kelamin
            $sub[] = substr($nip, -3, 3); // nomor urut

            return $sub[0] . $batas . $sub[1] . $batas . $sub[2] . $batas . $sub[3];
        } elseif ($panjang == 15) {
            $sub[] = substr($nip, 0, 8); // tanggal lahir
            $sub[] = substr($nip, 8, 6); // tanggal pengangkatan
            $sub[] = substr($nip, 14, 1); // jenis kelamin

            return $sub[0] . $batas . $sub[1] . $batas . $sub[2];
        } elseif ($panjang == 9) {
            $sub = str_split($nip, 3);

            return $sub[0] . $batas . $sub[1] . $batas . $sub[2];
        } else {
            return $nip;
        }
    }

    function convertDate($date)
    {
        $date = explode('-', $date);
        $dt = Carbon::create($date[1], $date[0]);
        $x = $dt->year . '-' . $dt->month;
        return $x;
    }

    function convertMonthYear($my)
    {
        $data = explode('-', $my);
        return $data[1] . '-' . $data[0];
    }

    function parseDateDt($date, $response)
    {
        $dt = Carbon::parse($date);
        return $dt->format("d");
    }

    function is_active($bool)
    {
        return $bool == true ?  "Headline" : "Draft";
    }
}
