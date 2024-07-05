@extends('layouts.app')

@section('dashboard')
@section('breadcrumb')
<div class="col-12 col-md-6 order-md-1 order-last">
    <h3>Dashboard</h3>
    <p class="text-subtitle text-muted">Halaman Dashboard.</p>
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
          Halaman Dashboard
        </li>
      </ol>
    </nav>
  </div>
@endsection
    <div class="row">
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                  <div class="stats-icon purple mb-2">
                    <i class="bi bi-people"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">
                    User
                  </h6>
                  <h6 class="font-extrabold mb-0">{{$user}}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                  <div class="stats-icon blue mb-2">
                    <i class="bi bi-house-gear-fill"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Sekolah</h6>
                  <h6 class="font-extrabold mb-0">{{$school}}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                  <div class="stats-icon green mb-2">
                    <i class="bi bi-collection"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Rekap Kehadiran</h6>
                  <h6 class="font-extrabold mb-0">{{$presensi}}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                  <div class="stats-icon red mb-2">
                    <i class="iconly-boldBookmark"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Hari Libur</h6>
                  <h6 class="font-extrabold mb-0">{{$libur}}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script src="speedometer.js"></script>
        <body onload='draw(0);'>
            <canvas id="speedometer" width="900" height="220"></canvas>
            <input class="form-control" type="text" id="txtSpeed" name="txtSpeed" value="{{ $persentaseHadir ?? '' }}" maxlength="2"/>
        </body>
        <form id="drawTemp">
            <style>
                .limited-width {
                    max-width: 120px;
                }
            </style>
           <p>Presentasi Kehadiran</p>
        </form>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body px-4 py-4-5">
                <div class="row">
                  <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                    <div class="stats-icon red mb-2">
                      <i class="iconly-boldBookmark"></i>
                    </div>
                  </div>
                  <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                    <h6 class="text-muted font-semibold">Total Hadir:</h6>
                    <h6 class="font-extrabold mb-0"> {{ $totalHadir ?? '' }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body px-4 py-4-5">
                <div class="row">
                  <div class="col-md-4  col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                    <div class="stats-icon red mb-2">
                      <i class="iconly-boldBookmark"></i>
                    </div>
                  </div>
                  <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                    <h6 class="text-muted font-semibold">Total Tidak Hadir:</h6>
                    <h6 class="font-extrabold mb-0">  {{ $totalTidakHadir ?? '' }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body px-4 py-4-5">
                <div class="row">
                  <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                    <div class="stats-icon red mb-2">
                      <i class="iconly-boldBookmark"></i>
                    </div>
                  </div>
                  <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                    <h6 class="text-muted font-semibold">Total Izin</h6>
                    <h6 class="font-extrabold mb-0">  {{ $totalIzin ?? '' }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body px-4 py-4-5">
                <div class="row">
                  <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                    <div class="stats-icon red mb-2">
                      <i class="iconly-boldBookmark"></i>
                    </div>
                  </div>
                  <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                    <h6 class="text-muted font-semibold">Total Tugas:</h6>
                    <h6 class="font-extrabold mb-0">  {{ $totalTugas ?? '' }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body px-4 py-4-5">
                <div class="row">
                  <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                    <div class="stats-icon red mb-2">
                      <i class="iconly-boldBookmark"></i>
                    </div>
                  </div>
                  <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                    <h6 class="text-muted font-semibold">Total Sakit:</h6>
                    <h6 class="font-extrabold mb-0">  {{ $totalSakit ?? '' }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body px-4 py-4-5">
                <div class="row">
                  <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                    <div class="stats-icon red mb-2">
                      <i class="iconly-boldBookmark"></i>
                    </div>
                  </div>
                  <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                    <h6 class="text-muted font-semibold">Total Cuti:</h6>
                    <h6 class="font-extrabold mb-0">  {{ $totalCuti ?? '' }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body px-4 py-4-5">
                <div class="row">
                  <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                    <div class="stats-icon red mb-2">
                      <i class="iconly-boldBookmark"></i>
                    </div>
                  </div>
                  <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                    <h6 class="text-muted font-semibold">Total Terlambat:</h6>
                    <h6 class="font-extrabold mb-0">  {{ $totalTerlambat ?? '' }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
            <!-- Total Cuti -->
            <div class="col-6 col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body px-4 py-4-5">
                  <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                      <div class="stats-icon green mb-2">
                        <i class="iconly-boldCalendar"></i>
                      </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                      <h6 class="text-muted font-semibold">Total Cuti:</h6>
                      <h6 class="font-extrabold mb-0">{{ $totalCuti ?? '' }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Total Pulang Cepat -->
            <div class="col-6 col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body px-4 py-4-5">
                  <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                      <div class="stats-icon blue mb-2">
                        <i class="iconly-boldArrow"></i>
                      </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                      <h6 class="text-muted font-semibold">Total Pulang Cepat:</h6>
                      <h6 class="font-extrabold mb-0">{{ $totalPulangCepat ?? '' }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Jumlah Terlambat -->
            <div class="col-6 col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body px-4 py-4-5">
                  <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                      <div class="stats-icon red mb-2">
                        <i class="iconly-boldClock"></i>
                      </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                      <h6 class="text-muted font-semibold">Jumlah Terlambat:</h6>
                      <h6 class="font-extrabold mb-0">{{ $jumlahTerlambat ?? '' }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Jumlah Tepat Waktu -->
            <div class="col-6 col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body px-4 py-4-5">
                  <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                      <div class="stats-icon purple mb-2">
                        <i class="iconly-boldCheck"></i>
                      </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                      <h6 class="text-muted font-semibold">Jumlah Tepat Waktu:</h6>
                      <h6 class="font-extrabold mb-0">{{ $jumlahTepatWaktu ?? '' }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Persentase Kehadiran -->
            <div class="col-6 col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body px-4 py-4-5">
                  <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                      <div class="stats-icon orange mb-2">
                        <i class="iconly-boldPieChart"></i>
                      </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                      <h6 class="text-muted font-semibold">Persentase Kehadiran:</h6>
                      <h6 class="font-extrabold mb-0">{{ $persentaseHadir ?? '' }}%</h6>
                    </div>
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
    <script>
    // Add an event listener to trigger the click event when the page loads
    document.addEventListener("DOMContentLoaded", function () {
        drawWithInputValue(); // Call the function directly when the page loads
    });

    function drawWithInputValue() {
        // Your existing code for handling the button click goes here
        // ...
    }
</script>
<script>
/*jslint plusplus: true, sloppy: true, indent: 4 */
(function () {
    "use strict";
    // this function is strict...
}());

var iCurrentSpeed = 20,
    iTargetSpeed = 20,
    bDecrement = null,
    job = null;

function degToRad(angle) {
    // Degrees to radians
    return ((angle * Math.PI) / 180);
}

function radToDeg(angle) {
    // Radians to degree
    return ((angle * 180) / Math.PI);
}

function drawLine(options, line) {
    // Draw a line using the line object passed in
    options.ctx.beginPath();

    // Set attributes of open
    options.ctx.globalAlpha = line.alpha;
    options.ctx.lineWidth = line.lineWidth;
    options.ctx.fillStyle = line.fillStyle;
    options.ctx.strokeStyle = line.fillStyle;
    options.ctx.moveTo(line.from.X,
        line.from.Y);

    // Plot the line
    options.ctx.lineTo(
        line.to.X,
        line.to.Y
    );

    options.ctx.stroke();
}

function createLine(fromX, fromY, toX, toY, fillStyle, lineWidth, alpha) {
    // Create a line object using Javascript object notation
    return {
        from: {
            X: fromX,
            Y: fromY
        },
        to:    {
            X: toX,
            Y: toY
        },
        fillStyle: fillStyle,
        lineWidth: lineWidth,
        alpha: alpha
    };
}

function drawOuterMetallicArc(options) {
    /* Draw the metallic border of the speedometer
     * Outer grey area
     */
/*    options.ctx.beginPath();

    // Nice shade of grey
    options.ctx.fillStyle = "rgb(127,127,127)";

    // Draw the outer circle
    options.ctx.arc(options.center.X,
        options.center.Y,
        options.radius,
        0,
        Math.PI,
        true);

    // Fill the last object
    options.ctx.fill();
*/
}

function drawInnerMetallicArc(options) {
    /* Draw the metallic border of the speedometer
     * Inner white area
     */

    /*options.ctx.beginPath();

    // White
    options.ctx.fillStyle = "rgb(255,255,255)";

    // Outer circle (subtle edge in the grey)
    options.ctx.arc(options.center.X,
                    options.center.Y,
                    (options.radius / 100) * 90,
                    0,
                    Math.PI,
                    true);

    options.ctx.fill();

    */
}

function drawMetallicArc(options) {
    /* Draw the metallic border of the speedometer
     * by drawing two semi-circles, one over lapping
     * the other with a bot of alpha transparency
     */

    drawOuterMetallicArc(options);
    drawInnerMetallicArc(options);
}

function drawBackground(options) {
    /* Black background with alphs transparency to
     * blend the edges of the metallic edge and
     * black background
     */
   var i = 0;

    options.ctx.globalAlpha = 0.2;
    options.ctx.fillStyle = "rgb(0,0,0)";

    // Draw semi-transparent circles
    for (i = 170; i < 180; i++) {
        options.ctx.beginPath();

        options.ctx.arc(options.center.X,
            options.center.Y,
            i,
            0,
            Math.PI,
            true);

        options.ctx.fill();
    }

}

function applyDefaultContextSettings(options) {
    /* Helper function to revert to gauges
     * default settings
     */

    options.ctx.lineWidth = 2;
    options.ctx.globalAlpha = 0.5;
    options.ctx.strokeStyle = "rgb(255, 255, 255)";
    options.ctx.fillStyle = 'rgb(255,255,255)';
}

function drawSmallTickMarks(options) {
    /* The small tick marks against the coloured
     * arc drawn every 5 mph from 10 degrees to
     * 170 degrees.
     */

    var tickvalue = options.levelRadius - 8,
        iTick = 0,
        gaugeOptions = options.gaugeOptions,
        iTickRad = 0,
        onArchX,
        onArchY,
        innerTickX,
        innerTickY,
        fromX,
        fromY,
        line,
        toX,
        toY;

    applyDefaultContextSettings(options);

    // Tick every 20 degrees (small ticks)
    for (iTick = 10; iTick < 180; iTick += 20) {

        iTickRad = degToRad(iTick);

        /* Calculate the X and Y of both ends of the
         * line I need to draw at angle represented at Tick.
         * The aim is to draw the a line starting on the
         * coloured arc and continueing towards the outer edge
         * in the direction from the center of the gauge.
         */

        onArchX = gaugeOptions.radius - (Math.cos(iTickRad) * tickvalue);
        onArchY = gaugeOptions.radius - (Math.sin(iTickRad) * tickvalue);
        innerTickX = gaugeOptions.radius - (Math.cos(iTickRad) * gaugeOptions.radius);
        innerTickY = gaugeOptions.radius - (Math.sin(iTickRad) * gaugeOptions.radius);

        fromX = (options.center.X - gaugeOptions.radius) + onArchX;
        fromY = (gaugeOptions.center.Y - gaugeOptions.radius) + onArchY;
        toX = (options.center.X - gaugeOptions.radius) + innerTickX;
        toY = (gaugeOptions.center.Y - gaugeOptions.radius) + innerTickY;

        // Create a line expressed in JSON
        line = createLine(fromX, fromY, toX, toY, "rgb(127,127,127)", 3, 0.6);

        // Draw the line
        drawLine(options, line);

    }
}

function drawLargeTickMarks(options) {
    /* The large tick marks against the coloured
     * arc drawn every 10 mph from 10 degrees to
     * 170 degrees.
     */

    var tickvalue = options.levelRadius - 8,
        iTick = 0,
        gaugeOptions = options.gaugeOptions,
        iTickRad = 0,
        innerTickY,
        innerTickX,
        onArchX,
        onArchY,
        fromX,
        fromY,
        toX,
        toY,
        line;

    applyDefaultContextSettings(options);

    tickvalue = options.levelRadius - 2;

    // 10 units (major ticks)
    for (iTick = 20; iTick < 180; iTick += 20) {

        iTickRad = degToRad(iTick);

        /* Calculate the X and Y of both ends of the
         * line I need to draw at angle represented at Tick.
         * The aim is to draw the a line starting on the
         * coloured arc and continueing towards the outer edge
         * in the direction from the center of the gauge.
         */

        onArchX = gaugeOptions.radius - (Math.cos(iTickRad) * tickvalue);
        onArchY = gaugeOptions.radius - (Math.sin(iTickRad) * tickvalue);
        innerTickX = gaugeOptions.radius - (Math.cos(iTickRad) * gaugeOptions.radius);
        innerTickY = gaugeOptions.radius - (Math.sin(iTickRad) * gaugeOptions.radius);

        fromX = (options.center.X - gaugeOptions.radius) + onArchX;
        fromY = (gaugeOptions.center.Y - gaugeOptions.radius) + onArchY;
        toX = (options.center.X - gaugeOptions.radius) + innerTickX;
        toY = (gaugeOptions.center.Y - gaugeOptions.radius) + innerTickY;

        // Create a line expressed in JSON
        line = createLine(fromX, fromY, toX, toY, "rgb(127,127,127)", 3, 0.6);

        // Draw the line
        drawLine(options, line);
    }
}

function drawTicks(options) {
    /* Two tick in the coloured arc!
     * Small ticks every 5
     * Large ticks every 10
     */
    drawSmallTickMarks(options);
    drawLargeTickMarks(options);
}

function drawTextMarkers(options) {
    /* The text labels marks above the coloured
     * arc drawn every 10 mph from 10 degrees to
     * 170 degrees.
     */
    var innerTickX = 0,
        innerTickY = 0,
        iTick = 0,
        gaugeOptions = options.gaugeOptions,
        iTickToPrint = 00;

    applyDefaultContextSettings(options);

    // Font styling
    options.ctx.font = 'italic 10px sans-serif';
    options.ctx.textBaseline = 'top';

    options.ctx.beginPath();

    // Tick every 20 (small ticks)
    for (iTick = 10; iTick < 180; iTick += 20) {

        innerTickX = gaugeOptions.radius - (Math.cos(degToRad(iTick)) * gaugeOptions.radius);
        innerTickY = gaugeOptions.radius - (Math.sin(degToRad(iTick)) * gaugeOptions.radius);

        // Some cludging to center the values (TODO: Improve)
        if (iTick <= 10) {
            options.ctx.fillText(iTickToPrint, (options.center.X - gaugeOptions.radius - 12) + innerTickX,
                    (gaugeOptions.center.Y - gaugeOptions.radius - 12) + innerTickY + 5);
        } else if (iTick < 50) {
            options.ctx.fillText(iTickToPrint, (options.center.X - gaugeOptions.radius - 12) + innerTickX - 5,
                    (gaugeOptions.center.Y - gaugeOptions.radius - 12) + innerTickY + 5);
        } else if (iTick < 90) {
            options.ctx.fillText(iTickToPrint, (options.center.X - gaugeOptions.radius - 12) + innerTickX,
                    (gaugeOptions.center.Y - gaugeOptions.radius - 12) + innerTickY);
        } else if (iTick === 90) {
            options.ctx.fillText(iTickToPrint, (options.center.X - gaugeOptions.radius - 12) + innerTickX + 4,
                    (gaugeOptions.center.Y - gaugeOptions.radius - 12) + innerTickY);
        } else if (iTick < 145) {
            options.ctx.fillText(iTickToPrint, (options.center.X - gaugeOptions.radius - 12) + innerTickX + 10,
                    (gaugeOptions.center.Y - gaugeOptions.radius - 12) + innerTickY);
        } else {
            options.ctx.fillText(iTickToPrint, (options.center.X - gaugeOptions.radius - 12) + innerTickX + 15,
                    (gaugeOptions.center.Y - gaugeOptions.radius - 12) + innerTickY + 5);
        }

        // MPH increase by 10 every 20 degrees
        //iTickToPrint += Math.round(2160 / 9);
         iTickToPrint += 10;
    }

    options.ctx.stroke();
}

function drawSpeedometerPart(options, alphaValue, strokeStyle, startPos) {
    /* Draw part of the arc that represents
    * the colour speedometer arc
    */

    options.ctx.beginPath();

    options.ctx.globalAlpha = alphaValue;
    options.ctx.lineWidth = 5;
    options.ctx.strokeStyle = strokeStyle;

    options.ctx.arc(options.center.X,
        options.center.Y,
        options.levelRadius,
        Math.PI + (Math.PI / 360 * startPos),
        0 - (Math.PI / 360 * 10),
        false);

    options.ctx.stroke();
}

function drawSpeedometerColourArc(options) {
    /* Draws the colour arc.  Three different colours
     * used here; thus, same arc drawn 3 times with
     * different colours.
     * TODO: Gradient possible?
     */

    var startOfGreen = 10,
        endOfGreen = 200,
        endOfOrange = 280;

    drawSpeedometerPart(options, 1.0, "rgb(204,254,255)", startOfGreen);
    drawSpeedometerPart(options, 0.9, "rgb(2,254,255)", endOfGreen);
    drawSpeedometerPart(options, 0.9, "rgb(1,127,127) ", endOfOrange);

}

function drawNeedleDial(options, alphaValue, strokeStyle, fillStyle) {
    /* Draws the metallic dial that covers the base of the
    * needle.
    */
    var i = 0;

    options.ctx.globalAlpha = alphaValue;
    options.ctx.lineWidth = 3;
    options.ctx.strokeStyle = strokeStyle;
    options.ctx.fillStyle = fillStyle;

    // Draw several transparent circles with alpha
    for (i = 0; i < 30; i++) {

        options.ctx.beginPath();
        options.ctx.arc(options.center.X,
            options.center.Y,
            i,
            0,
            Math.PI,
            true);

        options.ctx.fill();
        options.ctx.stroke();
    }
}

function convertSpeedToAngle(options) {
    /* Helper function to convert a speed to the
    * equivelant angle.
    */
    var iSpeed = (options.speed / 10),
        iSpeedAsAngle = ((iSpeed * 20) + 10) % 180;

    // Ensure the angle is within range
    if (iSpeedAsAngle > 180) {
        iSpeedAsAngle = iSpeedAsAngle - 180;
    } else if (iSpeedAsAngle < 0) {
        iSpeedAsAngle = iSpeedAsAngle + 180;
    }

    return iSpeedAsAngle;
}

function drawNeedle(options) {
    /* Draw the needle in a nice read colour at the
    * angle that represents the options.speed value.
    */

    var iSpeedAsAngle = convertSpeedToAngle(options),
        iSpeedAsAngleRad = degToRad(iSpeedAsAngle),
        gaugeOptions = options.gaugeOptions,
        innerTickX = gaugeOptions.radius - (Math.cos(iSpeedAsAngleRad) * 20),
        innerTickY = gaugeOptions.radius - (Math.sin(iSpeedAsAngleRad) * 20),
        fromX = (options.center.X - gaugeOptions.radius) + innerTickX,
        fromY = (gaugeOptions.center.Y - gaugeOptions.radius) + innerTickY,
        endNeedleX = gaugeOptions.radius - (Math.cos(iSpeedAsAngleRad) * gaugeOptions.radius),
        endNeedleY = gaugeOptions.radius - (Math.sin(iSpeedAsAngleRad) * gaugeOptions.radius),
        toX = (options.center.X - gaugeOptions.radius) + endNeedleX,
        toY = (gaugeOptions.center.Y - gaugeOptions.radius) + endNeedleY,
        line = createLine(fromX, fromY, toX, toY, "rgb(127, 127, 127)", 5, 0.6);

    drawLine(options, line);

    // Two circle to draw the dial at the base (give its a nice effect?)
    drawNeedleDial(options, 0.6, "rgb(127, 127, 127)", "rgb(255,255,255)");
    drawNeedleDial(options, 0.2, "rgb(127, 127, 127)", "rgb(127,127,127)");

}

function buildOptionsAsJSON(canvas, iSpeed) {
    /* Setting for the speedometer
    * Alter these to modify its look and feel
    */

    var centerX = 210,
        centerY = 210,
        radius = 150,
        outerRadius = 200;

    // Create a speedometer object using Javascript object notation
    return {
        ctx: canvas.getContext('2d'),
        speed: iSpeed,
        center:    {
            X: centerX,
            Y: centerY
        },
        levelRadius: radius - 10,
        gaugeOptions: {
            center:    {
                X: centerX,
                Y: centerY
            },
            radius: radius
        },
        radius: outerRadius
    };
}

function clearCanvas(options) {
    options.ctx.clearRect(0, 0, 800, 600);
    applyDefaultContextSettings(options);
}

function draw() {
    /* Main entry point for drawing the speedometer
    * If canvas is not support alert the user.
    */

    console.log('Target: ' + iTargetSpeed);
    console.log('Current: ' + iCurrentSpeed);

    var canvas = document.getElementById('speedometer'),
        options = null;

    // Canvas good?
    if (canvas !== null && canvas.getContext) {
        options = buildOptionsAsJSON(canvas, iCurrentSpeed);

        // Clear canvas
        clearCanvas(options);

        // Draw the metallic styled edge
        drawMetallicArc(options);

        // Draw thw background
        drawBackground(options);

        // Draw tick marks
        drawTicks(options);

        // Draw labels on markers
        drawTextMarkers(options);

        // Draw speeometer colour arc
        drawSpeedometerColourArc(options);

        // Draw the needle and base
        drawNeedle(options);

    } else {
        alert("Canvas not supported by your browser!");
    }

    if(iTargetSpeed == iCurrentSpeed) {
        clearTimeout(job);
        return;
    } else if(iTargetSpeed < iCurrentSpeed) {
        bDecrement = true;
    } else if(iTargetSpeed > iCurrentSpeed) {
        bDecrement = false;
    }

    if(bDecrement) {
        if(iCurrentSpeed - 10 < iTargetSpeed)
            iCurrentSpeed = iCurrentSpeed - 1;
        else
            iCurrentSpeed = iCurrentSpeed - 5;
    } else {

        if(iCurrentSpeed + 10 > iTargetSpeed)
            iCurrentSpeed = iCurrentSpeed + 1;
        else
            iCurrentSpeed = iCurrentSpeed + 5;
    }

    job = setTimeout("draw()", 5);
}

function drawWithInputValue() {

    var txtSpeed = document.getElementById('txtSpeed');

    if (txtSpeed !== null) {

        iTargetSpeed = txtSpeed.value;

        // Sanity checks
        if (isNaN(iTargetSpeed)) {
            iTargetSpeed = 0;
        } else if (iTargetSpeed < 0) {
            iTargetSpeed = 0;
        } else if (iTargetSpeed > 80) {
            iTargetSpeed = 80;
        }

        job = setTimeout("draw()", 5);

    }
}
</script>
@endsection



