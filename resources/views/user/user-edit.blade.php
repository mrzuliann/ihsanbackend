@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Daftar User</div>

                <div class="card-body">
                    <form method="POST"  action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" name="nip" aria-describedby="nip" value="{{ old('nip', $user->nip) }}">

                    </div>
                    <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp" value="{{ old('name', $user->name) }}">

                        </div>
                        <div class="form-group mt-2">
                            <label for="school_id">Sekolah</label>
                            <select class="form-control" name="school_id" id="school_id">
                                @foreach ($school as $data)
                                    <option value="{{ $data->id }}" {{ old('school_id', $user->school_id) == $data->id ? 'selected' : '' }}>
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="role_id">Role</label>
                            <select class="form-control" name="role_id" id="role_id">
                                @foreach ($role as $data)
                                    <option value="{{ $data->id }}" {{ old('role_id', $user->role_id) == $data->id ? 'selected' : '' }}>
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="gelar_depan">Gelar Depan</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="gelar_depan"
                                aria-describedby="gelar_depan" value="{{ old('gelar_depan', $user->gelar_depan) }}">
                        </div>
                        <div class="form-group">
                            <label for="gelar_belakang">Gelar Belakang</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="gelar_belakang"
                                aria-describedby="gelar_belakang" value="{{ old('gelar_belakang', $user->gelar_belakang) }}">
                        </div>
                            <div class="form-group mt-2">
                                <label for="agama">Agama</label>
                                <select class="form-control" id="agama" name="agama" value="{{ old('agama', $user->agama) }}">
                                    <!-- Add options for each agama -->
                                    <option value="{{ old('agama', $user->agama) }}">==Pilih Agama===</option>
                                    <option value="Islam" {{ old('agama', $user->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('agama', $user->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Hindu" {{ old('agama', $user->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('agama', $user->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old('agama', $user->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    <!-- Add more options if needed -->

                                    <!-- You can also dynamically populate options from a database or other source -->
                                </select>
                                @error('agama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="date">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $user->tempat_lahir) }}">
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="date">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}">
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="tipe_pegawai">Tipe Pegawai</label>
                                <select class="form-control" id="tipe_pegawai" name="tipe_pegawai" alue="{{ old('tipe_pegawai', $user->tipe_pegawai) }}">
                                    <!-- Add options for each agama -->
                                    <option value="">==Pilih Tipe Pegawai===</option>
                                    <option value="PNS" {{ old('tipe_pegawai', $user->tipe_pegawai) == 'PNS' ? 'selected' : '' }}>PNS</option>
                                    <option value="PPPK" {{ old('tipe_pegawai', $user->tipe_pegawai) == 'PPPK' ? 'selected' : '' }}>PPPK</option>
                                    <option value="Tenaga Kontrak Honorer" {{ old('tipe_pegawai', $user->tipe_pegawai) == 'Tenaga Kontrak Honorer' ? 'selected' : '' }}>Tenaga Kontrak Honorer</option>
                                    <!-- Add more options if needed -->

                                    <!-- You can also dynamically populate options from a database or other source -->
                                </select>
                                @error('tipe_pegawai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="exampleInputEmail1">Kedudukan PNS</label>
                                <select class="form-control" id="kedudukan_pns"  name="kedudukan_pns" alue="{{ old('kedudukan_pns', $user->kedudukan_pns) }}">
                                    <!-- Add options for each agama -->
                                    <option value="">==Pilih Kedudukan===</option>
                                        <option value="Aktif" {{ old('kedudukan_pns', $user->kedudukan_pns) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="Tidak Aktif" {{ old('kedudukan_pns', $user->kedudukan_pns) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                        <option value="Admin" {{ old('kedudukan_pns', $user->kedudukan_pns) == 'Admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="Pejabat Non PNS" {{ old('kedudukan_pns', $user->kedudukan_pns) == 'Pejabat Non PNS' ? 'selected' : '' }}>Pejabat Non PNS</option>
                                    </select>
                                    <!-- Add more options if needed -->
                                    <!-- You can also dynamically populate options from a database or other source -->
                                </select>
                                @error('kedudukan_pns')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="exampleInputEmail1">Status Pegawai</label>
                                <select class="form-control" id="status_pegawai"  name="status_pegawai" >
                                    <!-- Add options for each agama -->
                                    <option value="{{ old('status_pegawai', $user->status_pegawai) }}">==Pilih Status Pegawai===</option>
                                    <option value="Aktif" {{ old('status_pegawai', $user->status_pegawai) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="CLTN" {{ old('status_pegawai', $user->status_pegawai) == 'CLTN' ? 'selected' : '' }}>CLTN</option>
                                    <option value="Tugas Belajar" {{ old('status_pegawai', $user->status_pegawai) == 'Tugas Belajar' ? 'selected' : '' }}>Tugas Belajar</option>
                                    <option value="Pemberhentian Sementara" {{ old('status_pegawai', $user->status_pegawai) == 'Pemberhentian Sementara' ? 'selected' : '' }}>Pemberhentian Sementara</option>
                                    <option value="Penerima Uang Tunggu" {{ old('status_pegawai', $user->status_pegawai) == 'Penerima Uang Tunggu' ? 'selected' : '' }}>Penerima Uang Tunggu</option>
                                    <option value="Kepala Desa" {{ old('status_pegawai', $user->status_pegawai) == 'Kepala Desa' ? 'selected' : '' }}>Kepala Desa</option>
                                    <option value="Sedang dalam Proses Banding BAPEK" {{ old('status_pegawai', $user->status_pegawai) == 'Sedang dalam Proses Banding BAPEK' ? 'selected' : '' }}>Sedang dalam Proses Banding BAPEK</option>
                                    <option value="Pegawai Titipan" {{ old('status_pegawai', $user->status_pegawai) == 'Pegawai Titipan' ? 'selected' : '' }}>Pegawai Titipan</option>
                                    <option value="Pengungsi" {{ old('status_pegawai', $user->status_pegawai) == 'Pengungsi' ? 'selected' : '' }}>Pengungsi</option>
                                    <option value="Perpanjangan CLTN" {{ old('status_pegawai', $user->status_pegawai) == 'Perpanjangan CLTN' ? 'selected' : '' }}>Perpanjangan CLTN</option>
                                    <option value="PNS yang dinyatakan Hilang" {{ old('status_pegawai', $user->status_pegawai) == 'PNS yang dinyatakan Hilang' ? 'selected' : '' }}>PNS yang dinyatakan Hilang</option>
                                    <option value="PNS kena Hukuman Disiplin" {{ old('status_pegawai', $user->status_pegawai) == 'PNS kena Hukuman Disiplin' ? 'selected' : '' }}>PNS kena Hukuman Disiplin</option>
                                    <option value="CPNS" {{ old('status_pegawai', $user->status_pegawai) == 'CPNS' ? 'selected' : '' }}>CPNS</option>
                                    <option value="Diberhentikan" {{ old('status_pegawai', $user->status_pegawai) == 'Diberhentikan' ? 'selected' : '' }}>Diberhentikan</option>
                                    <option value="Punah" {{ old('status_pegawai', $user->status_pegawai) == 'Punah' ? 'selected' : '' }}>Punah</option>
                                    <option value="Eks PNS Timor Timur" {{ old('status_pegawai', $user->status_pegawai) == 'Eks PNS Timor Timur' ? 'selected' : '' }}>Eks PNS Timor Timur</option>
                                    <option value="TMS dari Pengadaan" {{ old('status_pegawai', $user->status_pegawai) == 'TMS dari Pengadaan' ? 'selected' : '' }}>TMS dari Pengadaan</option>
                                    <option value="Pembatalan NIP" {{ old('status_pegawai', $user->status_pegawai) == 'Pembatalan NIP' ? 'selected' : '' }}>Pembatalan NIP</option>
                                    <option value="Pemberhentian Hak Pensiun" {{ old('status_pegawai', $user->status_pegawai) == 'Pemberhentian Hak Pensiun' ? 'selected' : '' }}>Pemberhentian Hak Pensiun</option>
                                    <option value="Meninggal" {{ old('status_pegawai', $user->status_pegawai) == 'Meninggal' ? 'selected' : '' }}>Meninggal</option>
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
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" >
                                    <!-- Add options for each agama -->
                                    <option value="" {{ old('jenis_kelamin', $user->jenis_kelamin) == '' ? 'selected' : '' }}>==Pilih Jenis Kelamin===</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>

                                    <!-- Add more options if needed -->
                                    <!-- You can also dynamically populate options from a database or other source -->
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="eselon">Eselon</label>
                                <select class="form-control" id="eselon" name="eselon">
                                    <!-- Add options for each eselon -->
                                    <option value="">==Pilih Eselon===</option>
                                    <option value="I/A - Juru Muda" {{ old('tingkat_jabatan', $user->tingkat_jabatan) == 'I/A - Juru Muda' ? 'selected' : '' }}>I/A - Juru Muda</option>
                                    <option value="I/B - Juru Muda Tk.I" {{ old('tingkat_jabatan', $user->tingkat_jabatan) == 'I/B - Juru Muda Tk.I' ? 'selected' : '' }}>I/B - Juru Muda Tk.I</option>
                                    <option value="I/C - Juru" {{ old('tingkat_jabatan', $user->tingkat_jabatan) == 'I/C - Juru' ? 'selected' : '' }}>I/C - Juru</option>
                                    <option value="I/D - Juru Tk.1" {{ old('tingkat_jabatan', $user->tingkat_jabatan) == 'I/D - Juru Tk.1' ? 'selected' : '' }}>I/D - Juru Tk.1</option>
                                    <option value="II/A - Pengatur Muda" {{ old('tingkat_jabatan', $user->tingkat_jabatan) == 'II/A - Pengatur Muda' ? 'selected' : '' }}>II/A - Pengatur Muda</option>
                                    <option value="II/B - Pengatur Muda Tk.I" {{ old('tingkat_jabatan', $user->tingkat_jabatan) == 'II/B - Pengatur Muda Tk.I' ? 'selected' : '' }}>II/B - Pengatur Muda Tk.I</option>
                                    <option value="II/C - Pengatur" {{ old('tingkat_jabatan', $user->tingkat_jabatan) == 'II/C - Pengatur' ? 'selected' : '' }}>II/C - Pengatur</option>
                                    <option value="II/D - Pengatur Tk.1" {{ old('tingkat_jabatan', $user->tingkat_jabatan) == 'II/D - Pengatur Tk.1' ? 'selected' : '' }}>II/D - Pengatur Tk.1</option>
                                    <option value="III/A - Penata Muda" {{ old('tingkat_jabatan', $user->tingkat_jabatan) == 'III/A - Penata Muda' ? 'selected' : '' }}>III/A - Penata Muda</option>
                                    <option value="III/B - Penata Muda Tk.1" {{ old('tingkat_jabatan', $user->tingkat_jabatan) == 'III/B - Penata Muda Tk.1' ? 'selected' : '' }}>III/B - Penata Muda Tk.1</option>
                                    <option value="III/C - Penata Muda Tk.1" {{ old('tingkat_jabatan', $user->tingkat_jabatan) == 'III/C - Penata Muda Tk.1' ? 'selected' : '' }}>III/C - Penata Muda Tk.1</option>
                                    <option value="III/D - Penata Muda Tk.1" {{ old('tingkat_jabatan', $user->tingkat_jabatan) == 'III/D - Penata Muda Tk.1' ? 'selected' : '' }}>III/D - Penata Muda Tk.1</option>
                                    <option value="IV/A - Pembina" {{ old('tingkat_jabatan', $user->tingkat_jabatan) == 'IV/A - Pembina' ? 'selected' : '' }}>IV/A - Pembina</option>
                                    <option value="IV/B - Pembina Tk.1" {{ old('tingkat_jabatan', $user->tingkat_jabatan) == 'IV/B - Pembina Tk.1' ? 'selected' : '' }}>IV/B - Pembina Tk.1</option>

                                    <!-- Add more options if needed -->
                                    <!-- You can also dynamically populate options from a database or other source -->
                                </select>
                                @error('eselon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="jenis_fungsional">Jenis Fungsional</label>
                                <select class="form-control" id="jenis_fungsional" name="jenis_fungsional" >
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
                                <select class="form-control" id="Golongan" name="golongan" alue="{{ old('golongan', $user->golongan) }}" >
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
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="email" value="{{ old('email', $user->email) }}">
                        </div>
                        <div class="form-group mt-2">
                            <label for="avatar">Avatar</label>
                            @if($user->avatar)
                                <img src="{{ asset('public/avatars/' . $user->avatar) }}" alt="Avatar">
                                <a href="#">Hapus Avatar</a>
                            @else
                                <input type="file" class="form-control" name="avatar" id="avatar" accept="image/*">
                            @endif
                            @error('avatar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{{ old('password', $user->password) }}">
                        </div>
                        <button type="submit" class="btn btn-danger mt-3"><a href="{{ URL::previous() }}">Go Back</a></button>
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
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




