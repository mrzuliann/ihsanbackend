@extends('layouts.app')

@section('breadcrumb')
    <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Edit Pengajuan Cuti</h3>
        <p class="text-subtitle text-muted">Halaman Edit Pengajuan Cuti.</p>
    </div>
    <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Halaman Edit Pengajuan Cuti
                </li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Edit Pengajuan Cuti</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('pengajuancuti.update', $pengajuanCuti->pengajuan_id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <div class="form-group mt-2">
                            <label for="pegawai">Pegawai</label>
                            <select class="form-control" id="pegawai" name="pegawai" required>
                                <option value="">Pilih Pegawai</option>
                                @foreach ($daftarPegawai as $pegawai)
                                    <option value="{{ $pegawai->id }}"
                                        {{ $pegawai->id == $pengajuanCuti->pegawai ? 'selected' : '' }}>
                                        {{ $pegawai->name }} - {{ $pegawai->school ? $pegawai->school->name : '-' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pegawai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Sisipkan referensi ke Flatpickr CSS -->
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
                        <!-- Sisipkan referensi ke Flatpickr JavaScript -->
                        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

                        <div class="form-group mt-2">
                            <label for="date-range">Pilih Rentang Tanggal:</label>
                            <input type="text" id="date-range" class="form-control" placeholder="Pilih rentang tanggal"
                                readonly name="tanggal" id="tanggal"
                                value="{{ old('tanggal', $pengajuanCuti->tanggal_awal . ' to ' . $pengajuanCuti->tanggal_akhir) }}">
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                flatpickr("#date-range", {
                                    mode: "range", // Mode rentang tanggal
                                    dateFormat: "Y-m-d", // Format tanggal
                                    // Anda dapat menambahkan opsi tambahan sesuai kebutuhan
                                });
                            });
                        </script>

                        <div class="form-group mt-2">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="Cuti" {{ $pengajuanCuti->status == 'Cuti' ? 'selected' : '' }}>Cuti
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="lampiran">Lampiran (Hanya .docx dan .pdf)</label>
                            <input type="file" class="form-control" name="lampiran" id="lampiran">
                            @error('lampiran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-danger mt-3"><a href="{{ URL::previous() }}">Go
                                Back</a></button>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </div>
                </form>
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
