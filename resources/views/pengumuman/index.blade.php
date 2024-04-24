@extends('layouts.app')
@section('breadcrumb')
<div class="col-12 col-md-6 order-md-1 order-last">
    <h3>Pengumuman</h3>
    <p class="text-subtitle text-muted">Halaman Pengumuman.</p>
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
          Halaman Pengumuman
        </li>
      </ol>
    </nav>
  </div>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{url('create-pengumuman')}}" type="button" class="btn btn-info mb-2">+ Tambah Pengumuman</a>
            <div class="card">
                <div class="card-header">Daftar Sekolah</div>
                <div class="card-body">
                <table id="example" class="table table-striped table-reponsive" style="width:100%">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Tipe Peserta</th>
                            <th>Status</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengumuman as $item)
                      <tr>
    <td>{{$item->name}}</td>
    <td>{{$item->desc}}</td>
    <td>{{$item->tipe_peserta}}</td>
    <td>{{$item->status}}</td>
    <!-- Sisanya tetap tidak berubah -->
    @if(empty($item->image_file))
    <td><img src="{{ asset('yes.jpeg') }}" alt="Gambar Galeri" class="gambar-galeri circle-image" width="70" height="60" style="border-radius: 50%"></td>
    @else
    <td><img src="{{ asset('storage/pengumuman/' . $item->image_file) }}" alt="Gambar Galeri" class="gambar-galeri circle-image" width="70" height="60" style="border-radius: 50%"></td>
    @endif

    <td class="text-center">
        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('pengumuman.destroy', $item->id) }}" method="POST">
            <a href="{{ route('pengumuman.edit', $item->id) }}" class="btn btn-sm btn-primary">EDIT</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
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



