@extends('layouts.app')
@section('breadcrumb')
<div class="col-12 col-md-6 order-md-1 order-last">
    <h3>Hari Libur</h3>
    <p class="text-subtitle text-muted">Halaman Hari Libur.</p>
  </div>
  <div class="col-12 col-md-6 order-md-2 order-first">
    <nav
      aria-label="breadcrumb"
      class="breadcrumb-header float-start float-lg-end"
    >
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          Halaman Hari Libur
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
           <form action="{{ route('importholidays') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="input-group mb-3">
                <input type="file" name="file" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                <a href="{{url('downloadimportholidays')}}" type="button" class="btn btn-success">Download Format</a>
                <button class="btn btn-primary" type="submit" id="button-addon2">Import</button>
            </div>
            <a href="{{url('create-presensiholiday')}}" type="button" class="btn btn-info mb-2 mt-2">+ Tambah Hari Libur</a>
            <a class="btn btn-warning mb-2 mt-2" href="{{ route('exportholidays') }}"> Export Hari Libur </a>
        </form>
            {{-- <br> --}}
            {{-- Import --}}
            <div class="card">
                <div class="card-body">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama Hari Libur</th>
                            <th>Deskripsi Hari Libur</th>
                            <th>Tanggal Libur</th>
                            <th>Hari Libur</th>
                            <th>Type</th>
                            <th>Status</th>

                            <th style="width:10%;" align="center">Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presensiholiday as $data)
                        <tr>
                        <td>{{$data->holiday_name}}</td>
                        <td>{{$data->holiday_desc}}</td>
                        <td>{{$data->holiday_date}}</td>
                        <td>{{$data->holiday_day}}</td>
                        <td>{{$data->holiday_type}}</td>
                        <td>{{$data->holiday_status}}</td>
                        <td class="text-center">
                            <a href="{{ route('presensiholiday.edit', ['id' => $data->id]) }}" class="btn btn-sm btn-primary">Edit</a>


                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('presensiholiday.destroy', $data->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>




                        </td>
                        </tr>
                        @endforeach
                        {{-- @foreach($response as $data) --}}
                            {{-- {{$response}} --}}
                        {{-- @endforeach --}}
                    {{-- <td>{{$response->holiday_date}}</td>
                    <td>{{$response->holiday_name}}</td>
                    <td>{{$response->is_holiday}}</td> --}}
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



