@extends('layouts.app')
@section('breadcrumb')
<div class="col-12 col-md-6 order-md-1 order-last">
    <h3>Report </h3>
    <p class="text-subtitle text-muted">Halaman Report.</p>
  </div>
  <div class="col-12 col-md-6 order-md-2 order-first">
    <nav
      aria-label="breadcrumb"
      class="breadcrumb-header float-start float-lg-end"
    >
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
                <div class="card-header">Rekap Presensi Perhari</div>

                <div class="card-body">
                  <form action="{{ route('report.perhari') }}">
                    <div class="row">
                      <div class="col-md-6">
                        <label for="" class="form-label">Tahun</label>
                        <input name="date" type="date" step="1" value="{{ Carbon\carbon::now()->format('d-m-Y') }}" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label for="" class="form-label">Sekolah</label>
                        <select name="school" id="school" class="form-control">
                          <option selected>Sekolah</option>
                          @foreach($schools as $school)
                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-12 mt-3 text-end">
                        <button type="submit" class="btn btn-primary">Proces</button>
                      </div>
                    </div>
                  </form>
                  @isset($presensis)
                    <div class="table-responsive">
                      <table id="example" class="table table-striped mt-5" style="width:100%">
                        <thead>
                            <tr>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Sekolah</th>
                                <th>Terlambat</th>
                                {{-- <th>Checkin</th> --}}
                                {{-- <th>Pulang</th> --}}
                                <th>Pulang Cepat</th>
                                <th>Tepat Waktu</th>
                                <th>H</th>
                                <th>A</th>
                                <th>I</th>
                                <th>S</th>
                                <th>C</th>
                                <th>TL</th>
                                <th>IPC</th>
                                <th>Total</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($presensis as $item)

                            <tr>
                                <td>{{$item->user['nip']}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->user->school['name']}}</td>
                                <td>{{ $item->jumlah_terlambat }}</td>
                                <td>{{ $item->jumlah_pulang_cepat }}</td>
                                <td>{{ $item->jumlah_tepat_waktu }}</td>
                                <td>{{ $item->hadir }}</td>
                                <td>{{ $item->tidak_hadir }}</td>
                                <td>{{ $item->izin }}</td>
                                <td>{{ $item->sakit }}</td>
                                <td>{{ $item->cuti }}</td>
                                <td>{{ $item->terlambat }}</td>
                                <td>{{ $item->pulang_cepat }}</td>
                                <td>{{ $item->total }}</td>
                                <td>
                                  <form action="{{ route('report.detail', $item->user->id) }}">
                                    @csrf
                                    <input type="hidden" value="{{ $date }}" name="date">
                                    <button type="submit" class="btn btn-sm btn-primary">Detail</button>
                                  </form>
                                </td>

                                {{-- <button class="btn btn-sm btn-primary">{{$item2->presensihour['ph_name']}} {{$item->masuk}}</button></td>  --}}
                            </tr>
                            {{-- @endforeach --}}
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                  @endisset
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" class="init">

$(document).ready(function () {
	var table = $('#example').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );
});

</script>

@endsection



