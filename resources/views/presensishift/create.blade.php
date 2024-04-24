@extends('layouts.app')
@section('breadcrumb')
<div class="col-12 col-md-6 order-md-1 order-last">
    <h3>Shift Presensi </h3>
    <p class="text-subtitle text-muted">Halaman Presensi Shift</p>
  </div>
  <div class="col-12 col-md-6 order-md-2 order-first">
    <nav
      aria-label="breadcrumb"
      class="breadcrumb-header float-start float-lg-end"
    >
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard') }}">Shift</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          Halaman Shift
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
                <div class="card-header">Presensi Shift</div>
                <div class="card-body">
                    <form method="POST"  action="{{ route('presensishift-store')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Nama Shift</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="nama_shift" aria-describedby="emailHelp" value="">
                        </div>
                        <div class="form-group">
                            <label for="school_id">Sekolah</label>
                            <select name="school_id" id="school_id" class="form-control select2">
                                <option value="">Pilih Sekolah</option>
                                @foreach($schools as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
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








