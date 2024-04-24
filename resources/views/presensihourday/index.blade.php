@extends('layouts.app')
@section('breadcrumb')
<div class="col-12 col-md-6 order-md-1 order-last">
    <h3>Jam Presensi</h3>
    <p class="text-subtitle text-muted">Halaman Jam Presensi.</p>
  </div>
  <div class="col-12 col-md-6 order-md-2 order-first">
    <nav
      aria-label="breadcrumb"
      class="breadcrumb-header float-start float-lg-end" ?.,mn b>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          Halaman Jam Presensi
        </li>
      </ol>
    </nav>
  </div>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
           {{-- Import --}}
            <form action="{{ route('import') }}"
            method="POST"
            enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <a href="{{url('create-presensihourday')}}" type="button" class="btn btn-info mb-2 mt-2">+ Tambah Jam</a>
                <button class="btn btn-success mb-2 mt-2"> Import Jam Data </button>
                <a href="{{url('downloadimportholidays')}}" type="button" class="btn btn-success">Download Format</a>
                <a class="btn btn-warning mb-2 mt-2" href="{{ route('exportpresensihourday') }}"> Export Jam Data </a>
            </form>
            {{-- Import --}}
            <div class="card">
                <div class="card-body">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Jam Presensi</th>
                            <th>Nama Sekolah</th>
                            <th>Nama Shift</th>
                            <th>Hari</th>
                            <th>Mulai</th>
                            <th>Sampai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($presensihourday as $item)
                        <tr>
                            <td>{{ $item->presensihour ? $item->presensihour->ph_name : 'Presensihour Not Found' }}</td>
                            <td>{{ $item->school ? $item->school->name : 'School Not Found' }}</td>
                            <td>{{ $item->shift ? $item->shift->shift_name : 'Shift Not Found' }}</td>
                            <td>{{ $item->ph_day }}</td>
                            <td>{{ $item->ph_time_start }}</td>
                            <td>{{ $item->ph_time_end }}</td>
                            <td class="text-center">
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                    action="{{ route('presensihourday.destroy', $item->phd_id) }}" method="POST">
                                    <a href="{{ route('presensihourday.edit', $item->phd_id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
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



