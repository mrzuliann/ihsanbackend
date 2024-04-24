@extends('layouts.app')
@section('breadcrumb')
<div class="col-12 col-md-6 order-md-1 order-last">
    <h3>Pengumuman</h3>
    <p class="text-subtitle text-muted">Halaman Pengumuman</p>
  </div>
  <div class="col-12 col-md-6 order-md-2 order-first">
    <nav
      aria-label="breadcrumb"
      class="breadcrumb-header float-start float-lg-end"
    >
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard') }}">Pengumuman</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          Halaman Pengumuman
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
                <div class="card-header">Pengumuman</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('pengumuman-update', ['id' => $id]) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="name" value="{{ $pengumuman->name }}">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="headline" {{ $pengumuman->status === 'headline' ? 'selected' : '' }}>Headline</option>
                                <option value="biasa" {{ $pengumuman->status === 'biasa' ? 'selected' : '' }}>Biasa</option>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="desc">Desc</label>
                            <textarea class="form-control" name="desc" aria-describedby="status">{{ $pengumuman->desc }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="image_file">File</label>
                            <!-- Tambahkan atribut name="image_file" pada input file -->
                            <input type="file" class="form-control" id="image_file" name="image_file">
                        </div>
                        <div class="form-group">
                            <label for="tipe_peserta">Tipe Peserta</label>
                            <select name="tipe_peserta" id="tipe_peserta" class="form-control">
                                <option value="headline" {{ $pengumuman->tipe_peserta === 'headline' ? 'selected' : '' }}>Tipe</option>
                                <option value="biasa" {{ $pengumuman->tipe_peserta === 'biasa' ? 'selected' : '' }}>Biasa</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-danger mt-3" onclick="window.history.back()">Go Back</button>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </div>

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








