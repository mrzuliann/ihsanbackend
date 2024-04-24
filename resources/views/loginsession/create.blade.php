@extends('layouts.app')
@section('breadcrumb')
<div class="col-12 col-md-6 order-md-1 order-last">
    <h3>Login Session </h3>
    <p class="text-subtitle text-muted">Halaman Login Session.</p>
  </div>
  <div class="col-12 col-md-6 order-md-2 order-first">
    <nav
      aria-label="breadcrumb"
      class="breadcrumb-header float-start float-lg-end"
    >
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard') }}">Login Session</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          Halaman Login Session
        </li>
      </ol>
    </nav>
  </div>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Login Session</div>
                <div class="card-body">
                    <form method="POST"  action="{{ route('loginsession-store')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="form-group">
                            <label for="hari">Hari</label>
                            <select name="hari" id="hari" class="form-control select2">
                                <option value="0">Pilih Hari</option>
                                @foreach($day as $value)
                                    <option value="{{$value}}">{{($value)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="shift">Shift</label>
                            <select name="shift" id="shift" class="form-control select2">
                                <option value="0">Pilih Shift</option>
                                @foreach($shift as $value)
                                    <option value="{{$value->shift_id}}">{{$value->shift_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jam_absen">Jam Absen</label>
                            <select name="jam_absen" id="jam_absen" class="form-control select2">
                                <option value="">Pilih Jam Absen</option>
                                @foreach($presensihour as $value)
                                    <option value="{{$value->id}}">{{$value->ph_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="school">Sekolah</label>
                            <select name="school" id="school" class="form-control select2">
                                <option value="0">Semua Sekolah</option>
                                @foreach($school as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Mulai</label>
                            <input type="time" class="form-control" id="ph_time_start" name="ph_time_start" aria-describedby="emailHelp" value="name">
                        </div>
                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Sampai</label>
                            <input type="time" class="form-control" id="ph_time_end" name="ph_time_end" aria-describedby="emailHelp" value="name">
                        </div>
                        {{-- <button type="submit" class="btn btn-danger mt-3"><a href="{{ URL::previous() }}">Go Back</a></button> --}}
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
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








