@extends('layouts.app')
@section('breadcrumb')
<div class="col-12 col-md-6 order-md-1 order-last">
    <h3>Sub Lokasi</h3>
    <p class="text-subtitle text-muted">Halaman Sub Lokasi.</p>
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
          Halaman Sub Lokasi
        </li>
      </ol>
    </nav>
  </div>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{url('create-subloc-school')}}" type="button" class="btn btn-info mb-2">+ Tambah Sub Loacation Sekolah</a>
            <div class="card">
                <div class="card-header"><h3>Sub Lokasi</h3></div>
                <div class="card-body">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama Sub Lokasi</th>
                            <th>Sekolah</th>
                            <th>Sub Unit</th>
                            <th>Radius</th>
                            <th>Lat.</th>
                            <th>Long.</th>
                            <th>Temukan Lokasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach($pengumuman as $item) --}}
                        <tr>
                            {{-- <td>{{$item->name}}</td>
                            <td>{{$item->latitude}}</td>
                            <td>{{$item->longitude}}</td>
                            <td>{{$item->radius}}</td> --}}
                            <td class="text-center">
                                {{-- <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                    action="{{ route('pengumuman.destroy', $item->id) }}" method="POST">
                                    <a href="{{ route('pengumuman.edit', $item->id) }}"
                                        class="btn btn-sm btn-primary">EDIT</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                </form> --}}
                            </td>
                        </tr>
                        {{-- @endforeach --}}
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
