@extends('layouts.app')
@section('breadcrumb')

<div class="col-12 col-md-6 order-md-1 order-last">
    <h3>Sub Lokasi Per User</h3>
    <p class="text-subtitle text-muted">Halaman Sublokasi Per User.</p>
  </div>
  <div class="col-12 col-md-6 order-md-2 order-first">
    <nav
      aria-label="breadcrumb"
      class="breadcrumb-header float-start float-lg-end"
    >
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          Halaman Sub Lokasi Per User
        </li>
      </ol>
    </nav>
  </div>
@endsection
@section('content')
