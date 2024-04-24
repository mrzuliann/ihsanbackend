@extends('layouts.app')
@section('breadcrumb')
<div class="col-12 col-md-6 order-md-1 order-last">
    <h3>Pegawai</h3>
    <p class="text-subtitle text-muted">Halaman Pegawai.</p>
  </div>
  <div class="col-12 col-md-6 order-md-2 order-first">
    <nav
      aria-label="breadcrumb"
      class="breadcrumb-header float-start float-lg-end">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          Halaman Pegawai
        </li>
      </ol>
    </nav>
  </div>
@endsection
@section('content')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
           {{-- Import --}}
           <form action="{{ route('importuser') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="input-group mb-3">
                <input type="file" name="file" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                <a href="{{url('downloadimport')}}" type="button" class="btn btn-success">Download Format</a>
                <button class="btn btn-primary" type="submit" id="button-addon2">Import</button>
            </div>
            <a href="{{url('create-user')}}" type="button" class="btn btn-info mb-2 mt-2">+ Tambah User</a>
            <a class="btn btn-warning mb-2 mt-2" href="{{ route('export') }}"> Export User Data </a>
        </form>
            {{-- <br> --}}
            {{-- Import --}}
            <div class="card">
                <div class="card-body">
                {{-- <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Avatar</th>
                            <th>Sekolah</th>
                            <th>Role</th>
                            <th style="width:70%;" text="center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <table id="users-table" class="table table-striped">
                            <!-- Struktur tabel -->
                        </table>
                        @foreach($users as $item)
                        <tr>
                            <td>{{$item->nip}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            @if(empty($item->avatar))
                            <td><img src="{{ asset('yes.jpeg') }}" alt="Gambar Galeri" class="gambar-galeri circle-image" width="70" height="60" style="border-radius: 50%"></td></td>
                            @else
                            <td><img src="{{ asset('storage/avatars/' . $item->avatar) }}" alt="Gambar Galeri" class="gambar-galeri circle-image" width="70" height="60" style="border-radius: 50%"></td>
                            @endif
                            {{-- <td>{{$item->school['name']}}</td> --}}
                            {{-- @if(empty($item->school['name']))
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
                                    action="{{ route('user.destroy', $item->id) }}" method="POST">
                                    <a href="{{ route('user.edit', $item->id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>  --}} 
                 <table class="table" id="dataTable_admin">
                    <tbody>
                    </tbody>
                </table>
                    {{-- <table class="table table-bordered" id="dataTable">
                        <tbody>
                        </tbody>
                    </table> --}}
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
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> 
{{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> --}}
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css"> --}}
<script type="text/javascript">
    $(document).ready(function() {
        fetch_data()

        function fetch_data() {
            $('#dataTable').DataTable({
                pageLength: 5,
                lengthChange: true,
                bFilter: true,
                destroy: true,
                processing: true,
                responsive: true,
                serverSide: true,
                oLanguage: {
                    sZeroRecords: "Tidak Ada Data",
                    sSearch: "Pencarian _INPUT_",
                    sLengthMenu: "_MENU_",
                    sInfo: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    sInfoEmpty: "0 data",
                    oPaginate: {
                        sNext: "<i class='fa fa-angle-right'></i>",
                        sPrevious: "<i class='fa fa-angle-left'></i>"
                    }
                },
                ajax: {
                    url: "{{ route('user.data') }}",
                    type: "GET"

                },
                columns: [{
                        data: 'DT_RowIndex',
                        title: 'No',
                        name: 'DT_Row_Index',
                        "className": "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        title: 'Judul',
                        data: 'judul',
                    }, 
            });
        }

    });
</script>
 <script type="text/javascript">
    $(document).ready(function() {
        fetch_data()

        function fetch_data() {
            $('#dataTable_admin').DataTable({
                pageLength: 10,
                lengthChange: true,
                bFilter: true,
                destroy: true,
                processing: true,
             responsive: true,
                serverSide: true,
                oLanguage: {
                    sZeroRecords: "Tidak Ada Data",
                    sSearch: "Pencarian _INPUT_",
                    sLengthMenu: "_MENU_",
                    sInfo: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    sInfoEmpty: "0 data",
                    oPaginate: {
                        sNext: ">",
                        sPrevious: "<"
                    }
                },
                ajax: {
                    url: "{{ route('user.data') }}",
                    type: "GET"

                },
                columns: [{
                        data: 'DT_RowIndex',
                        title: 'No',
                        name: 'DT_Row_Index',
                        "className": "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        title: 'Nama',
                        data: 'name',
                    },
                    {
                        title: 'NIP',
                        data: 'nip',
                    },
                    {
                        title: 'Email',
                        data: 'email'
                    },
                    {
                        "data": "avatar",
                        "title": "Avatar",
                        "render": function (data, type, full, meta) {
                            if (data) {
                                return '<img src="{{ asset('storage/avatars/') }}/' + data + '" alt="Gambar Galeri" class="gambar-galeri circle-image" width="70" height="60" style="border-radius: 50%">';
                            } else {
                                return '<img src="{{ asset('yes.jpeg') }}" alt="Gambar Galeri" class="gambar-galeri circle-image" width="70" height="60" style="border-radius: 50%">';
                            }
                        },
                        "orderable": false,
                        "searchable": false
                    },
                    {
                        title: 'Sekolah',
                        data: 'school_name',
                        "className": "text-center"
                    },
                    // {
                    //     title: 'Tipe File',
                    //     data: 'tipe_file',
                    //     "className": "text-center"
                    // },
                    // {
                    //     title: 'File',
                    //     data: 'file',
                    //     "className": "text-center"
                    // },
                    // {
                    //     title: 'Status',
                    //     data: 'status',
                    //     "className": "text-center"
                    // },
                    //  {
                    //     title: 'Tanggal Upload',
                    //     data: 'created_at',
                    //     "className": "text-center"
                    // }, 
                        {
                        title: 'Action',
                        data: 'action',
                        "className": "text-center",
                        orderable: false,
                        searchable: false
                        }, 
                ]
            });
        }
    });
</script>
@endsection



