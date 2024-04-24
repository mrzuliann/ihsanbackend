@extends('layouts.app')
@section('breadcrumb')

<div class="col-12 col-md-6 order-md-1 order-last">
    <h3>Sekolah</h3>
    <p class="text-subtitle text-muted">Halaman Sekolah.</p>
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
          Halaman Sekolah
        </li>
      </ol>
    </nav>
  </div>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                @csrf
                <a class="btn btn-warning mb-2 mt-2" href="{{ route('exportschools') }}"> Export Sekolah Data </a>
                <div class="input-group mb-3">

                    <input type="file" name="file" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <a href="{{url('downloadimportsekolah')}}" type="button" class="btn btn-success">Download Format</a>
                    <button class="btn btn-primary" type="submit" id="button-addon2">Import</button>
                </div>
            </form>
            <a href="{{url('create-school')}}" type="button" class="btn btn-info mb-2">+ Tambah Sekolah</a>
            <div class="card">
                <div class="card-header">Daftar Sekolah</div>

                <div class="card-body">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama Sekolah</th>
                            <th>Sekolah Latitude</th>
                            <th>Sekolah Longitude</th>
                            <th>Sekolah Radius</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($school as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->latitude}}</td>
                            <td>{{$item->longitude}}</td>
                            <td>{{$item->radius}}</td>
                            <td class="text-center">
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                    action="{{ route('school.destroy', $item->id) }}" method="POST">
                                    <a href="{{ route('school.edit', $item->id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
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



