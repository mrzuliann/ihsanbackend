@extends('layouts.app')
@section('breadcrumb')
    <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Event</h3>
        <p class="text-subtitle text-muted">Halaman Event.</p>
    </div>
    <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Halaman event
                </li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="{{ url('create-event') }}" type="button" class="btn btn-info mb-2">+ Tambah Event</a>
                <div class="card">
                    <div class="card-header">Daftar Event</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Event</th>
                                        <th>Ditambahkan Pada</th>
                                        <th>Nama Lokasi</th>
                                        <th>Tanggal</th>
                                        <th>Mulai</th>
                                        <th>Sampai</th>
                                        <th>Rutin</th>
                                        <th>Bersamaan Dengan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp

                                    @foreach ($events as $event)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $event->event_name }}</td>
                                            <td>{{ $event->created_at }}</td>
                                            <td>{{ $event->event_location_name }}</td>
                                            <td>{{ $event->event_date }}</td>
                                            {{-- <td>{{ $event->event_rutin }}</td> --}}
                                            <td>{{ $event->event_start_time }}</td>
                                            <td>{{ $event->event_end_time }}</td>
                                            <td>{{ $event->ph_id }}</td>
                                            <td>{{ $event->event_desc }}</td>
                                            <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('event.destroy', $event->event_id) }}" method="POST">
                                              <a href="{{ route('event.edit', $event->event_id) }}" class="btn btn-sm btn-primary">Edit</a>
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
@endsection
