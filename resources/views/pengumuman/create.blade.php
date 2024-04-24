@extends('layouts.app')
@section('breadcrumb')
<div class="col-12 col-md-6 order-md-1 order-last">
    <h3>Daftar Pengumuman</h3>
    <p class="text-subtitle text-muted">Daftar Pengumuman</p>
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
          Halaman Pengajuan Cuti
        </li>
      </ol>
    </nav>
  </div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <div class="card-header"><h2>Daftar Pengumuman</h2></div>
                <div class="card-body">
                    <form method="POST" action="{{ url('store-pengumuman') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="name">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="headline">Headline</option>
                                <option value="biasa">Biasa</option>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="desc">Desc</label>
                            <textarea class="form-control" name="desc" aria-describedby="status"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image_file">File</label>
                            <!-- Tambahkan atribut name="image_file" pada input file -->
                            <input type="file" class="form-control" id="image_file" name="image_file">
                        </div>
                        <div class="form-group">
                            <label for="tipe_peserta">Tipe Peserta</label>
                            <select name="tipe_peserta" id="tipe_peserta" class="form-control">
                                <option value="headline">Tipe</option>
                                <option value="biasa">Biasa</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </div>
                    </form>
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



