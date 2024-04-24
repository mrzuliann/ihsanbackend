@extends('layouts.app')
@section('breadcrumb')
<div class="col-12 col-md-6 order-md-1 order-last">
    <h3>Jam Presensi </h3>
    <p class="text-subtitle text-muted">Halaman Presensi Jam.</p>
  </div>
  <div class="col-12 col-md-6 order-md-2 order-first">
    <nav
      aria-label="breadcrumb"
      class="breadcrumb-header float-start float-lg-end"
    >
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard') }}">Jam</a>
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
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Presensi Jam</div>
                <div class="card-body">
                    <form method="POST"  action="{{ route('presensihour-store')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="ph_name" aria-describedby="emailHelp" value="name">
                        </div>
                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Keterangan</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="ph_desc" aria-describedby="emailHelp" value="Desc">
                        </div>
                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Time Start</label>
                            <input type="time" class="form-control" id="exampleInputEmail1" name="ph_time_start" aria-describedby="emailHelp" value="">
                        </div>
                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Time End</label>
                            <input type="time" class="form-control" id="exampleInputEmail1" name="ph_time_end" aria-describedby="emailHelp" value="">
                        </div>
                        <button type="submit" class="btn btn-danger mt-3"><a href="{{ URL::previous() }}">Go Back</a></button>
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








