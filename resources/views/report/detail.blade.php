@extends('layouts.app')

@section('breadcrumb')
<div class="col-12 col-md-6 order-md-1 order-last">
    <h3>Report </h3>
    <p class="text-subtitle text-muted">Halaman Report.</p>
</div>
<div class="col-12 col-md-6 order-md-2 order-first">
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('dashboard') }}">Report</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Halaman Report
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="text-uppercase ms-4">Rekap Presensi {{ $presensi->first()->user->name }} ({{ $presensi->first()->user->nip }})</div>
                <div class="text-uppercase ms-4">Bulan {{ Carbon\Carbon::parse($presensi->first()->tanggal)->format('M') }} {{ $year }}</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped mt-5" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Tanggal/Hari</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Presensi Masuk</th>
                                    <th>Presensi Pulang</th>
                                    <th>Hari Libur</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $startOfMonth = now()->startOfMonth();
                                $endOfMonth = now()->endOfMonth();
                                $datesInRange = Carbon\CarbonPeriod::create($startOfMonth, $endOfMonth)->toArray();
                                @endphp
                                @foreach($datesInRange as $date)
                                <tr>
                                    <td>{{ $date->isoFormat('dddd, D MMM Y') }}</td>
                                    <td>{{ $presensi->first()->user['nip'] }}</td>
                                    <td>{{ $presensi->first()->user->name }}</td>
                                    <style>
                                        .btn-td {
                                            font-size: 12px; /* Ubah ukuran font sesuai kebutuhan */
                                            padding: 5px 10px; /* Ubah ukuran padding sesuai kebutuhan */
                                        }
                                    </style>
                                    <td>
                                        @php
                                        $filteredPresensiMasuk = $presensi->where('tanggal', $date->format('Y-m-d'))->where('ph_id', 1);
                                        $isWeekend = ($date->isWeekend() || $date->isSunday());
                                        $filteredHoliday = $presensiholiday->where('holiday_date', $date->format('Y-m-d'))->first();
                                        $isHoliday = ($isWeekend || $filteredHoliday);
                                        @endphp
                                        @if($filteredPresensiMasuk->isNotEmpty())
                                            <button class="btn btn-primary text-uppercase">{{ $filteredPresensiMasuk->first()->presensihour->ph_name }}-{{ $filteredPresensiMasuk->first()->masuk }}</button>
                                        @else
                                            <button class="btn btn-primary text-uppercase">Tidak Hadir <span>00:00</span></button>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                        $filteredPresensiPulang = $presensi->where('tanggal', $date->format('Y-m-d'))->where('ph_id', 2);
                                        @endphp
                                        @if($filteredPresensiPulang->isNotEmpty())
                                            <button class="btn btn-primary text-uppercase">{{ $filteredPresensiPulang->first()->presensihour->ph_name }}-{{ $filteredPresensiPulang->first()->pulang }}</button>
                                        @else
                                            <button class="btn btn-primary text-uppercase">Tidak Hadir <span>00:00</span></button>
                                        @endif
                                    </td>
                                    <td>
                                        @if($filteredHoliday)
                                            @if($isWeekend)
                                                <span class="text-danger">Hari Libur: Minggu</span>
                                            @else
                                                <div class="text-center">
                                                    <span class="text-danger">{{ $filteredHoliday->holiday_desc }}</span>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js"></script>
<script type="text/javascript" class="init">
    $(document).ready(function () {
        var table = $('#example').DataTable({
            responsive: false,
            ordering: false, // Menonaktifkan sorting huruf
            pageLength: 10, // Menentukan jumlah entri per halaman default
            searching: false, // Menonaktifkan fitur pencarian
            paging: false, // Menonaktifkan pagination
            info: false // Menonaktifkan informasi jumlah entri
        });
    });
</script>

@endsection
