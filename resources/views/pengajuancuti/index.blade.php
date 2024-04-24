@extends('layouts.app')
@section('breadcrumb')
    <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Pengajuan Cuti</h3>
        <p class="text-subtitle text-muted">Halaman Pengajuan Cuti.</p>
    </div>
    <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
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
            <div class="col-md-12">
                <a href="{{url('create-pengajuancuti')}}" type="button" class="btn btn-info mb-2">+ Tambah Pengajuan Cuti</a>
                <div class="card">
                    <div class="card-header">
                        <h3>Pengajuan Cuti</h3>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Pegawai</th>
                                    <th>Tanggal Awal</th>
                                    <th>Tanggal Akhir</th>
                                    <th>status</th>
                                    <th>lampiran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->pegawai }}</td>

                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_awal)->format('d-m-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_akhir)->format('d-m-Y') }}</td>
                                    <td>{{$item->status}}</td>
                                    <td>
                                        @if($item->lampiran)
                                        <a href="{{ url('storage/lampiran/' . $item->lampiran) }}" class="btn btn-sm btn-success" download>
                                            Download Lampiran
                                        </a>
                                        @else
                                            Tidak Ada Lampiran
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                            action="{{ route('pengajuancuti.destroy', $item->pengajuan_id) }}" method="POST">
                                            <a href="{{ route('pengajuancuti.edit', $item->pengajuan_id) }}"
                                                class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                                {{$item->link}}
                                @endforeach
                            </tbody>
                        </table>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" class="init">
        $(document).ready(function() {
            var table = $('#example').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true
            });
        });
    </script>
      <script type="text/javascript" class="init">
        $(document).ready(function() {
            var table = $('#example').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true
            });
        });
    </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
     <script type="text/javascript">
         Dropzone.options.imageUpload = {
             maxFilesize         :       1,
             acceptedFiles: ".jpeg,.jpg,.png,.gif"
         };
     </script>
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            fetch_data()

            function fetch_data() {
                $('#dataTable_admin').DataTable({
                    pageLength: 5,
                    lengthChange: true,
                    bFilter: true,
                    destroy: true,
                    processing: true,
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
                        url: "{{ route('pengajuancuti.data') }}",
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
                            title: 'Pegawai',
                            data: 'Pegawai',
                        },
                        {
                            title: 'Tanggal Mulai',
                            data: 'tanggal_awal',
                            "className": "text-center"
                        },
                        {
                            title: 'Tanggal Akhir',
                            data: 'tanggal_akhir',
                            "className": "text-center"
                        },
                        {
                            title: 'Lampiran',
                            data: 'lampiran',
                            "className": "text-center"
                        },
                        {
                            title: 'Status',
                            data: 'status',
                            "className": "text-center"
                        },
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
