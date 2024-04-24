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
                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="email" value="{{ old('email', $user->email) }}">
                        </div>
                        <div class="form-group mt-2">
                            <label for="avatar">Avatar</label>
                            <input type="file" class="form-control" name="avatar" id="avatar" accept="image/*">
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




