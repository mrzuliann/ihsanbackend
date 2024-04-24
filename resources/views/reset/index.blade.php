@extends('layouts.app')
@section('breadcrumb')
<div class="col-12 col-md-6 order-md-1 order-last">
    <h3>Reset Password</h3>
    <p class="text-subtitle text-muted">Halaman Reset Password.</p>
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
          Halaman Reset Password
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
                {{-- <input type="file" name="file" class="form-control"> --}}
                {{-- <br> --}}
                {{-- <a href="{{url('create-user')}}" type="button" class="btn btn-info mb-2 mt-2">+ Tambah User</a>
                <button class="btn btn-success mb-2 mt-2"> Import User Data </button>
                <a class="btn btn-warning mb-2 mt-2" href="{{ route('export') }}"> Export User Data </a> --}}
                {{-- <a href="{{url('import-user')}}" type="button" class="btn btn-success mb-2">+ Import User</a>     --}}
            </form>
            {{-- <br> --}}
            {{-- Import --}}
            <div class="card">
                <div class="card-body">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Sekolah</th>
                            <th>Role</th>
                            <th style="width:70%;" text="center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $item)
                        <tr>
                            <td>{{$item->nip}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            {{-- <td>{{$item->school['name']}}</td> --}}
                            @if(empty($item->school['name']))
                            <td><button class="btn btn-sm btn-danger">Null</button></td>
                            @else
                            <td>{{$item->school['name']}}</td>
                            @endif
                            @if(empty($item->role['name']))
                            <td><button class="btn btn-sm btn-danger">Null</button></td>
                            @else
                            <td>
                            <button class="btn btn-sm btn-success">{{$item->role['name']}}</button></td>
                            @endif
                            <td class="text-center">
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                    action="{{ route('reset.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Reset Password</button>
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



