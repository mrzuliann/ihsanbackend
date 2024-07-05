<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\School;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportUser;
use App\Exports\ExportUser;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index()
    {
        // $users = User::all()->load('school');
        $users = User::with('school')->paginate(10);
        // dd($users[0]->school_id->name);
        return view('user.user',compact('users'));
    }

     public function DataTable(Request $request)
    {
        if ($request->ajax()) {

            // $datas = user::all();
            $sekolah = User::with(['school' => function ($query) {
                $query->select('id', 'name'); // Pilih kolom yang ingin Anda muat
            }])->get();
            $datas = DB::table('users')->get();
            return DataTables::of($sekolah)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('school_name', function($item) {
                    return $item->school ? $item->school->name : '-';
                })
                ->addColumn('action', function ($user) {
                    $editBtn = '<a href="' . route('user.edit', $user->id) . '" class="edit btn btn-sm btn-info" style="color: #fff;background-color: #3DCB3A;border-color: #8ad3d3"> <i class="fa fa-edit"></i> Edit </a>';
                    $deleteBtn = '<form onsubmit="return confirm(\'Apakah Anda Yakin ?\');" action="' . route('user.destroy', $user->id) . '" method="POST">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                                </form>';

                    return $editBtn . $deleteBtn;
                })
                ->rawColumns(['action'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
        }
    }

    function create()
    {
        $role = Role::all();
        $school = School::all();
        return view('user.create-user',compact('school','role'));
    }

    // function store(Request $request)
    public function store(Request $request)
{
    $this->validate($request, [
        'nip' => 'required',
        'name' => 'required',
        'school_id' => 'required',
        'role_id' => 'required',
        'email' => 'required',
        'password' => 'required',
    ]);

    // Inisialisasi nilai default untuk avatar
    $avatarName = 'default_avatar.jpg';

    // Periksa apakah file avatar diunggah
    if ($request->hasFile('avatar')) {
        // Mengambil file avatar dari request
        $avatarFile = $request->file('avatar');
        // Menggenerasi nama unik untuk file avatar
        $avatarName = 'ava_user' . $request->user_id . '_' . now()->format('YmdHis') . '.' . $avatarFile->getClientOriginalExtension();
        // Menyimpan file avatar ke storage (asumsi Anda menggunakan storage disk 'public')
        $avatarFile->storeAs('public/avatars', $avatarName);
    }

     $user = User::create([
            'nip' => $request->nip,
            'name' => $request->name,
            'gelar_depan' => $request->gelar_depan,
            'gelar_belakang' => $request->gelar_belakang,
            'tipe_pegawai' => $request->tipe_pegawai,
            'agama' => $request->agama,
            'kedudukan_pns' => $request->kedudukan_pns,
            'status_pegawai' => $request->status_pegawai,
            'jenis_kelamin' => $request->jenis_kelamin,
            'golongan' => $request->golongan,
            'eselon' => $request->eselon,
            'jenis_fungsional' => $request->jenis_fungsional,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'school_id' => $request->school_id,
            'role_id' => $request->role_id,
            'email' => $request->email,
            'avatar' => $avatarName,
            'password' => Hash::make($request->password),
        ]);

    $token = $user->createToken('auth_token')->plainTextToken;

    // Redirect kembali dengan pesan sukses
    return redirect()->back()->with('message', 'Data added Successfully');
}

    public function edit($id)
    {
        $user = user::findOrFail($id);
        $role = Role::all();
        $school = School::all();
        return view('user.user-edit', compact('user','role','school'));
    }

    public function update(Request $request, $id)
    {
        //validate form
        //avatar
        // Mengambil file avatar dari request
        $avatarFile = $request->file('avatar');
         // Menggenerasi nama unik untuk file avatar
        $avatarName = 'ava_user' . $request->user_id . '_' . now()->format('YmdHis') . '.' . $avatarFile->getClientOriginalExtension();
        // Menyimpan file avatar ke storage (asumsi Anda menggunakan storage disk 'public')
        $avatarFile->storeAs('public/avatars', $avatarName);
        //
       $user = \App\Models\User::findOrFail($id);
       $user->nip = $request->get('nip');
       $user->name = $request->get('name');
       $user->gelar_depan = $request->get('gelar_depan');
       $user->gelar_belakang = $request->get('gelar_belakang');
       $user->tipe_pegawai = $request->get('tipe_pegawai');
       $user->agama = $request->get('agama');
       $user->kedudukan_pns = $request->get('kedudukan_pns');
       $user->status_pegawai = $request->get('status_pegawai');
       $user->jenis_kelamin = $request->get('jenis_kelamin');
       $user->golongan = $request->get('golongan');
       $user->eselon = $request->get('eselon');
       $user->jenis_fungsional = $request->get('jenis_fungsional');
       $user->tanggal_lahir = $request->get('tanggal_lahir');
       $user->tempat_lahir = $request->get('tempat_lahir');
       $user->school_id = $request->get('school_id');
       $user->role_id = $request->get('role_id');
       $user->email = $request->get('email');
       $user->avatar = $request->get('avatar');
       $user->password = Hash::make($request->get('password'));
       $user->update();
       // dd($user);
       //redirect to index
       return Redirect::back()->with('message','Data Update Successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if ($user) {
            return redirect()
                ->route('user.index')
                ->with('error','Data Deleted Successfully');
        } else {
            return redirect()
                ->route('user.index')
                ->with('error','Data Deleted Successfully');
        }

        // if ($user) {
        //     return view('user')
        //         ->with([
        //             'success' => 'User has been deleted successfully'
        //         ]);
        // } else {
        //     return view('user')
        //         ->with([
        //             'error' => 'User problem has occurred, please try again'
        //         ]);
        // }
    }

    public function import(Request $request)
    {
        Excel::import(new ImportUser,
        $request->file('file')->store('files'));
        return Redirect::back()->with('message','Data import Successfully');
    }

    public function importView(Request $request)
    {
        Excel::import(new ImportUser,
        $request->file('file')->store('files'));
        return Redirect::back()->with('message','Data import Successfully');
    }

    public function exportUsers()
    {
        return Excel::download(new ExportUser, 'users.xlsx');
    }

    public function downloadfimport()
    {
        $filePath = public_path("formatimport.xlsx");
    	$headers = ['Content-Type: application/xlsx'];
    	$fileName = time().'.xlsx';

    	return response()->download($filePath, $fileName, $headers);
    }
}
