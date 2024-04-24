<html>
<head>
    @include("layouts.header")
    <link rel="stylesheet" href="{{ asset('css/login.css') }}?version=2">
</head>

<body id="vanta" style="height: 100vh; width: 100vw">
<div class="container">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div class="py-3">
                    <img src="{{asset('balangan.png')}}" alt="logo" height="70">
                </div>
                <div class="py-3">
                    <img src="{{asset('tutwuri.png')}}" alt="logo" height="70">
                </div>
            </div>
        </div>
        <div class="col-sm-7 mx-auto">
            {{-- <div class="card card-signin my-2"> --}}
                <div class="card-body text-center">
                    @yield('login')
                    @yield('register')
                </div>
            {{-- </div> --}}
        </div>
    </div>


</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r121/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.net.min.js"></script>
<script>
    VANTA.NET({
        el: "#vanta",
        mouseControls: true,
        touchControls: true,
        gyroControls: false,
        minHeight: 100.00,
        minWidth: 100.00,
        scale: 1.00,
        scaleMobile: 1.00,
        color: 0x23153C,
        backgroundColor: 0x23153C,
        backgroundAlpha: 0
    })
</script>
</body>
</html>
