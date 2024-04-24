@extends('layouts.app')
@section('breadcrumb')
    <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Pegawai</h3>
        <p class="text-subtitle text-muted">Halaman Tambah Pegawai.</p>
    </div>
    <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{url('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Halaman Tambah Pegawai
                </li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="container">
        {{-- <div class="row justify-content-center"> --}}
        {{-- <div class="col-md-10"> --}}
        <div class="card">
            <div class="card-header">
                <h3>Tambah Pegawai</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ url('store-user') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" name="nip"
                            aria-describedby="nip" required>
                    </div>
                    <div class="form-group">
                        <label for="gelar_depan">Gelar Depan</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="gelar_depan"
                            aria-describedby="gelar_depan">
                    </div>
                    <div class="form-group">
                        <label for="gelar_belakang">Gelar Belakang</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="gelar_belakang"
                            aria-describedby="gelar_belakang" required>
                    </div>
                    <div class="form-group">
                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="name"
                                aria-describedby="emailHelp" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="agama">Agama</label>
                            <select class="form-control" id="agama" name="agama" required>
                                <!-- Add options for each agama -->
                                <option value="">==Pilih Agama===</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                                <!-- Add more options if needed -->

                                <!-- You can also dynamically populate options from a database or other source -->
                            </select>
                            @error('agama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="date">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="date">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="tipe_pegawai">Tipe Pegawai</label>
                            <select class="form-control" id="tipe_pegawai" name="tipe_pegawai" required>
                                <!-- Add options for each agama -->
                                <option value="">==Pilih Tipe Pegawai===</option>
                                <option value="PNS">PNS</option>
                                <option value="PPPK">PPPK</option>
                                <option value="Tenaga Kontrak Honorer">Tenaga Kontrak Honorer</option>
                                <!-- Add more options if needed -->

                                <!-- You can also dynamically populate options from a database or other source -->
                            </select>
                            @error('tipe_pegawai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                aria-describedby="emailHelp" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Kedudukan PNS</label>
                            <select class="form-control" id="kedudukan_pns"  name="kedudukan_pns" required>
                                <!-- Add options for each agama -->
                                <option value="">==Pilih Kedudukan===</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                                <option value="Admin">Admin</option>
                                <option value="Pejabat Non PNS">Pejabat Non PNS</option>
                                <!-- Add more options if needed -->
                                <!-- You can also dynamically populate options from a database or other source -->
                            </select>
                            @error('kedudukan_pns')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Status Pegawai</label>
                            <select class="form-control" id="status_pegawai"  name="status_pegawai" required>
                                <!-- Add options for each agama -->
                                <option value="">==Pilih Status Pegawai===</option>
                                <option value="Aktif">Aktif</option>
                                <option value="CLTN">CLTN</option>
                                <option value="Tugas Belajar">Tugas Belajar</option>
                                <option value="Pemberhentian Sementara">Pemberhentian Sementara</option>
                                <option value="Penerima Uang Tunggu">Penerima Uang Tunggu</option>
                                <option value="Pemberhentian Sementara">Pemberhentian Sementara</option>
                                <option value="Kepala Desa">Kepala Desa</option>
                                <option value="Sedang dalam Proses Banding BAPEK">Sedang dalam Proses Banding BAPEK</option>
                                <option value="Pegawai Titipan">Pegawai Titipan</option>
                                <option value="Pengungsi">Pengungsi</option>
                                <option value="Perpanjangan CLTN">Perpanjangan CLTN</option>
                                <option value="PNS yang dinyatakan Hilang">PNS yang dinyatakan Hilang</option>
                                <option value="PNS kena Hukuman Disiplin">PNS kena Hukuman Disiplin</option>
                                <option value="CPNS">CPNS</option>
                                <option value="Diberhentikan">Diberhentikan</option>
                                <option value="Punah">Punah</option>
                                <option value="Eks PNS Timor Timur">Eks PNS Timor Timur</option>
                                <option value="TMS dari Pengadaan">TMS dari Pengadaan</option>
                                <option value="Pembatalan NIP">Pembatalan NIP</option>
                                <option value="Pemberhentian Hak Pensiun">Pemberhentian Hak Pensiun</option>
                                <option value="Meninggal">Meninggal</option>
                                <option value="Pensiun Dini">Pensiun Dini</option>
                                <option value="Sakit/Ujur">Sakit/Ujur</option>
                                <option value="Mutasi">Mutasi</option>
                                <option value="MPP">MPP</option>
                                <!-- Add more options if needed -->
                                <!-- You can also dynamically populate options from a database or other source -->
                            </select>
                            @error('status_pegawai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                <!-- Add options for each agama -->
                                <option value="">==Pilih Jenis Kelamin===</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                                <!-- Add more options if needed -->
                                <!-- You can also dynamically populate options from a database or other source -->
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="eselon">Eselon</label>
                            <select class="form-control" id="eselon" name="eselon" required>
                                <!-- Add options for each eselon -->
                                <option value="">==Pilih Eselon===</option>
                                <option value="PEjabat">Pejabat</option>
                                <option value="I/A">I/A</option>
                                <option value="I/B">I/B</option>
                                <option value="II/A">II/A</option>
                                <option value="III/B">III/A</option>
                                <option value="III/B">III/B</option>
                                <option value="IV/A">IV/A</option>
                                <option value="IV/B">IV/B</option>
                                <option value="JFT">JFT</option>
                                <option value="V">V</option>
                                <option value="JFU">JFU</option>
                                <!-- Add more options if needed -->
                                <!-- You can also dynamically populate options from a database or other source -->
                            </select>
                            @error('eselon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="jenis_fungsional">Jenis Fungsional</label>
                            <select class="form-control" id="jenis_fungsional" name="jenis_fungsional" required>
                                <!-- Add options for each jenis_fungsional -->
                                <option value="">==Pilih Jenis Fungsional===</option>
                                <option value="Fungsional Umum">Fungsional Umum</option>
                                <option value="Fungsional Tertentu">Fungsional Tertentu</option>
                                <option value="Struktural">Struktural</option>
                                <!-- Add more options if needed -->
                                <!-- You can also dynamically populate options from a database or other source -->
                            </select>
                            @error('jenis_fungsional')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="Golongan">Golongan</label>
                            <select class="form-control" id="Golongan" name="golongan" required>
                                <!-- Add options for each Golongan -->
                                <option value="">==Pilih Golongan===</option>
                                <option value="I/A - Juru Muda">I/A - Juru Muda</option>
                                <option value="I/B - Juru Muda Tk.I">I/B</option>
                                <option value="I/C - Juru">I/C</option>
                                <option value="I/D - Juru Tk.1">I/D</option>
                                <option value="II/A - Pengatur Muda">II/A</option>
                                <option value="II/B - Pengatur Muda Tk.I">II/B</option>
                                <option value="II/C - Pengatur">II/C</option>
                                <option value="II/D - Pengatur Tk.1">II D</option>
                                <option value="III/A - Penata Muda">III/A</option>
                                <option value="III/B - Penata Muda Tk.1">III/B</option>
                                <option value="III/C - Penata Muda Tk.1">III/C</option>
                                <option value="III/D - Penata Muda Tk.1">III/D</option>
                                <option value="IV/A - Pembina ">IV/A Pembina</option>
                                <option value="IV/B - Pembina Tk.1">IV/B </option>
                                <!-- Add more options if needed -->
                                <!-- You can also dynamically populate options from a database or other source -->
                            </select>
                            @error('golongan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="avatar">Avatar</label>
                            <input type="file" class="form-control" name="avatar" id="avatar" accept="image/*">
                            @error('avatar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="school">Sekolah</label>
                            <select class="form-control" id="school_id" name="school_id">
                                @foreach ($school as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('school_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role_id" name="role_id">
                                @foreach ($role as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-2">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                                placeholder="Password">
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-danger mt-3"><a href="{{ URL::previous() }}">Go
                                Back</a></button>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
        {{-- </div> --}}
        {{-- </div> --}}
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
