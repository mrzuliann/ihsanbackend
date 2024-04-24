@extends('layouts.app')

@section('breadcrumb')
    <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Edit Event</h3>
        <p class="text-subtitle text-muted">Halaman Edit Event</p>
    </div>
    <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('event.index') }}">Event</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Edit
                </li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card-body">
                <form method="POST" action="{{ route('event.update', $event->event_id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <div class="form-group mt-2">
                            <label for="event_name">Nama Acara</label>
                            <input type="text" class="form-control @error('event_name') is-invalid @enderror"
                                id="event_name" name="event_name" aria-describedby="event_name"
                                value="{{ old('event_name', $event->event_name) }}">
                            @error('event_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="event_desc">Deskripsi Acara</label>
                            <textarea class="form-control @error('event_desc') is-invalid @enderror"
                                name="event_desc">{{ old('event_desc', $event->event_desc) }}</textarea>
                            @error('event_desc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="ph_id">Bersamaan Dengan*</label>
                            <select class="form-control select2 @error('ph_id') is-invalid @enderror"
                                id="ph_id" name="ph_id" aria-describedby="emailHelp">
                                <option value="">Pilih Opsi</option>
                                <option value="1" {{ old('ph_id', $event->ph_id) == 1 ? 'selected' : '' }}>Presensi Masuk</option>
                                <option value="2" {{ old('ph_id', $event->ph_id) == 2 ? 'selected' : '' }}>Presensi Pulang</option>
                            </select>
                            @error('ph_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div>
                            <label for="event_date">Tanggal Event</label>
                            <input type="date" id="event_date" name="event_date" class="form-control"
                                value="{{ old('event_date', $event->event_date) }}" required>
                        </div>

                        <div>
                            <label for="event_start_time">Jam Mulai</label>
                            <input type="time" id="event_start_time" name="event_start_time" class="form-control"
                                value="{{ old('event_start_time', $event->event_start_time) }}" required>
                        </div>

                        <div>
                            <label for="event_end_time">Jam Selesai</label>
                            <input type="time" id="event_end_time" name="event_end_time" class="form-control"
                                value="{{ old('event_end_time', $event->event_end_time) }}" required>
                        </div>

                        <div class="form-group mt-2">
                            <label for="event_location_name">Nama Lokasi</label>
                            <input type="text" class="form-control @error('event_location_name') is-invalid @enderror"
                                id="event_location_name" name="event_location_name"
                                value="{{ old('event_location_name', $event->event_location_name) }}">
                            @error('event_location_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="event_tipe_peserta">Tipe Peserta</label>
                            <select name="event_tipe_peserta" id="event_tipe_peserta" class="form-control">
                                <option value="Semua Sekolah" {{ old('event_tipe_peserta', $event->event_tipe_peserta) == 'Semua Sekolah' ? 'selected' : '' }}>Semua Sekolah</option>
                                <option value="Sekolah Tertentu" {{ old('event_tipe_peserta', $event->event_tipe_peserta) == 'Sekolah Tertentu' ? 'selected' : '' }}>Sekolah Tertentu</option>
                                <option value="Pegawai Tertentu" {{ old('event_tipe_peserta', $event->event_tipe_peserta) == 'Pegawai Tertentu' ? 'selected' : '' }}>Pegawai Tertentu</option>
                            </select>
                        </div>

                        <!-- Tambahkan elemen form lain sesuai kebutuhan -->

                        {{-- Form lokasi dengan peta --}}
                        <div>
                            <label for="event_lat">Latitude: </label>
                            <input type="text" id="event_lat" name="event_lat" class="form-control"
                                value="{{ old('event_lat', $event->event_lat) }}" />
                        </div>
                        <div>
                            <label for="event_lng">Longitude: </label>
                            <input type="text" id="event_lng" name="event_lng" class="form-control"
                                value="{{ old('event_lng', $event->event_lng) }}" />
                        </div>
                        <div>
                            <label for="event_radius">Radius: </label>
                            <input type="text" id="event_radius" name="event_radius" class="form-control"
                                value="{{ old('event_radius', $event->event_radius) }}" />
                        </div>
                        <br><br>
                        <div id="map" style="width:100%; height:400px; background-color:#000000;"></div>

                        <button type="submit" class="btn btn-danger mt-3"><a href="{{ URL::previous() }}">Go Back</a></button>
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
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
                  <script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key=AIzaSyBtnPVw4o2H1ZvDtRT8l8OTKCzS60eV0as"></script>
                  <script src="{{ asset("plugins/jquery-locationpicker-plugin-master/dist/locationpicker.jquery.js") }}"></script>
                  <script type="text/javascript" src="path-to-your-jquery-1.4.4.min.js"></script>
                  <script
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtnPVw4o2H1ZvDtRT8l8OTKCzS60eV0as&callback=initMap&v=weekly"
                        defer
                      ></script>
                    <style>
                        .pac-container {
                            z-index: x 9999999999;
                        }
                    </style>
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

                    <!-- JAVASCRIPT -->
                    <script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false'></script>
                    <script type="text/javascript" src="jquery-1.4.4.min.js"></script>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            var Circle = null;
                            var Radius = $("#event_radius").val();

                            var StartPosition = new google.maps.LatLng(-2.35835, 115.45873);

                            function DrawCircle(Map, Center, Radius) {
                                if (Circle != null) {
                                    Circle.setMap(null);
                                }

                                if (Radius > 0) {
                                    Radius *= 2;
                                    Circle = new google.maps.Circle({
                                        center: Center,
                                        radius: Radius,
                                        strokeColor: "#0000FF",
                                        strokeOpacity: 0.35,
                                        strokeWeight: 2,
                                        fillColor: "#0000FF",
                                        fillOpacity: 0.20,
                                        map: Map
                                    });
                                }
                            }

                            function SetPosition(Location, Viewport) {
                                Marker.setPosition(Location);
                                if (Viewport) {
                                    Map.fitBounds(Viewport);
                                    Map.setZoom(map.getZoom() + 2);
                                } else {
                                    Map.panTo(Location);
                                }
                                Radius = $("#event_radius").val();
                                DrawCircle(Map, Location, Radius);
                                $("#event_lat").val(Location.lat().toFixed(5));
                                $("#event_lng").val(Location.lng().toFixed(5));
                            }

                            var MapOptions = {
                                zoom: 13,
                                center: StartPosition,
                                mapTypeId: google.maps.MapTypeId.ROADMAP,
                                mapTypeControl: false,
                                disableDoubleClickZoom: true,
                                streetViewControl: false
                            };

                            var MapView = $("#map");
                            var Map = new google.maps.Map(MapView.get(0), MapOptions);

                            var Marker = new google.maps.Marker({
                                position: StartPosition,
                                map: Map,
                                title: "Drag Me",
                                draggable: true
                            });

                            google.maps.event.addListener(Marker, "dragend", function (event) {
                                SetPosition(Marker.position);
                            });

                            $("#event_radius").keyup(function () {
                                google.maps.event.trigger(Marker, "dragend");
                            });

                            google.maps.event.addListener(Map, 'click', function (event) {
                                Marker.setPosition(event.latLng);
                                SetPosition(Marker.position);
                            });

                            DrawCircle(Map, StartPosition, Radius);
                            SetPosition(Marker.position);

                        });
                    </script>

                    {{-- <script type="text/javascript">
                        $(document).ready(function() {

                            var Circle = null;
                            var Radius = $("#radius").val();

                            var StartPosition = new google.maps.LatLng(-2.35835, 115.45873);

                            function DrawCircle(Map, Center, Radius) {

                                if (Circle != null) {
                                    Circle.setMap(null);
                                }

                                if (Radius > 0) {
                                    Radius *= 2;
                                    Circle = new google.maps.Circle({
                                        center: Center,
                                        radius: Radius,
                                        strokeColor: "#0000FF",
                                        strokeOpacity: 0.35,
                                        strokeWeight: 2,
                                        fillColor: "#0000FF",
                                        fillOpacity: 0.20,
                                        map: Map
                                    });
                                }
                            }
                            function SetPosition(Location, Viewport) {
                                Marker.setPosition(Location);
                                if (Viewport) {
                                    Map.fitBounds(Viewport);
                                    Map.setZoom(map.getZoom() + 2);
                                } else {
                                    Map.panTo(Location);
                                }
                                Radius = $("#radius").val();
                                DrawCircle(Map, Location, Radius);
                                $("#latitude").val(Location.lat().toFixed(5));
                                $("#longitude").val(Location.lng().toFixed(5));
                            }
                            var MapOptions = {
                                zoom: 13,
                                center: StartPosition,
                                mapTypeId: google.maps.MapTypeId.ROADMAP,
                                mapTypeControl: false,
                                disableDoubleClickZoom: true,
                                streetViewControl: false
                            };

                            var MapView = $("#map");
                            var Map = new google.maps.Map(MapView.get(0), MapOptions);

                            var Marker = new google.maps.Marker({
                                position: StartPosition,
                                map: Map,
                                title: "Drag Me",
                                draggable: true
                            });

                            google.maps.event.addListener(Marker, "dragend", function(event) {
                                SetPosition(Marker.position);
                            });

                            $("#radius").keyup(function() {
                                google.maps.event.trigger(Marker, "dragend");
                            });

                            DrawCircle(Map, StartPosition, Radius);
                            SetPosition(Marker.position);

                        });
                    </script> --}}
                @endsection

