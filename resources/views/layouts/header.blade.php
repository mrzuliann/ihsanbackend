<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Presensi</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css') }}" />
    {{-- Toastr --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}" />

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('balangan.png') }}">

    <!-- essentials css -->

    {{-- <link rel="stylesheet" href="{{ asset('plugins/parsley/parsley.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('plugins/toastr/build/toastr.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset("plugins/jquery-confirm/dist/jquery-confirm.min.css") }}"> --}}

    <!-- App css -->
    {{-- <link href="{{ asset('vertical/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/> --}}
    {{-- <link href="{{ asset('vertical/assets/css/icons.css') }}" rel="stylesheet" type="text/css"/> --}}
    {{-- <link href="{{ asset('vertical/assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css"/> --}}
    {{-- <link rel="stylesheet" href="{{ asset('plugins/pace/themes/blue/pace-theme-minimal.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/preloader.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/css/perfect-scrollbar.min.css" />

    {{-- <link rel="stylesheet" href="{{asset('plugins/pace/themes/red/pace-theme-minimal.css')}}"> --}}
    {{-- <script src="{{ asset('vertical/assets/js/modernizr.min.js') }}"></script> --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- The "defer" attribute is important to make sure Alpine waits for Livewire to load first. -->
    <link
      rel="shortcut icon"
      href="assets/images/logo/favicon.svg"
      type="image/x-icon"
    />
    <link
      rel="shortcut icon"
      href="assets/images/logo/favicon.png"
      type="image/png"
    />
  </head>
