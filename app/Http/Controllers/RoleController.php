<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportSchool;
use App\Exports\ExportSchool;
use DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $role = role::all();
          return view('role.index', [
              'role' => $role
          ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role.create-role');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);
        Role::create([
            'name' => $request->name,
        ]);
        // dd($request->all());
        return redirect()->action('App\Http\Controllers\RoleController@index')->with('message','Data added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = \App\Models\Role::findOrFail($id);
        $role->name = $request->get('name');
        $role->save();

          //redirect to index
          return redirect()->route('role.index')->with(['message' => 'Data Berhasil Di Update!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        if ($role) {
            return redirect()
                ->route('role.index')
                ->with('error','Data Deleted Successfully');
        } else {
            return redirect()
                ->route('role.index')
                ->with('error','Data Deleted Successfully');
        }
    }
}
