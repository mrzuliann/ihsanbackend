<?php

namespace App\Http\Controllers;

use App\Models\LoginSession;
use Illuminate\Http\Request;

class LoginSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('loginsession.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoginSession  $loginSession
     * @return \Illuminate\Http\Response
     */
    public function show(LoginSession $loginSession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LoginSession  $loginSession
     * @return \Illuminate\Http\Response
     */
    public function edit(LoginSession $loginSession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LoginSession  $loginSession
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoginSession $loginSession)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoginSession  $loginSession
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoginSession $loginSession)
    {
        //
    }
}
