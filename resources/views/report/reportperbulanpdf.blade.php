<!DOCTYPE html>
<html>
<head>
	<title>Rekap Laporan Kehadiran Sekolah </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="{{asset('js/vue.js')}}"></script>
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>

	<center>
		<table align="center">
		<tr>
					<img src="{{ public_path("balangan.png") }}" alt="" style="width: 120px; height: 90px;">

					<td><center><font size="2"><b>
						PEMERINTAH DAERAH KABUPATEN BALANGAN</b><br/>
						<b>Dinas Pendidikan dan Kebudayaan Kabupaten Balangan</b></font><br/>
						<span style="font-size:10pt;"><b>Jalan Ahmad Yani KM 2.5, Paringin Selatan, Lingsir, Kec. Paringin Sel., Kabupaten Balangan, Kalimantan Selatan 71662</b><br/><b>
						website : www.dinaspendidikan.balangankab.go.id email : dinaspendidikan@gmail.com</b></span>
					</td>

                    <img src="{{ public_path("tutwuri.png") }}" alt="" style="width: 100px; height: 90px;">
					</th></center>

		</tr>
		</table>
        <br>
	</center>
	<table class='table table-bordered'>
        <div class="table-responsive">
            <table id="example" class="table table-striped mt-5" style="width:100%">
              <thead>
                  <tr>
                      <th>NIP</th>
                      <th>Nama</th>
                      <th>Sekolah</th>
                      <th>Terlambat</th>
                      <th>Pulang Cepat</th>
                      <th>Tepat Waktu</th>
                      <th>H</th>
                      <th>A</th>
                      <th>I</th>
                      <th>S</th>
                      <th>C</th>
                      <th>TL</th>
                      <th>IPC</th>
                      <th>Total</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($presensis as $item)
                  <tr>
                      <td>{{$item->user['nip']}}</td>
                      <td>{{$item->user->name}}</td>
                      <td>{{$item->user->school['name']}}</td>
                      <td>{{ $item->jumlah_terlambat }}</td>
                      <td>{{ $item->jumlah_pulang_cepat }}</td>
                      <td>{{ $item->jumlah_tepat_waktu }}</td>
                      <td>{{ $item->hadir }}</td>
                      <td>{{ $item->tidak_hadir }}</td>
                      <td>{{ $item->izin }}</td>
                      <td>{{ $item->sakit }}</td>
                      <td>{{ $item->cuti }}</td>
                      <td>{{ $item->terlambat }}</td>
                      <td>{{ $item->pulang_cepat }}</td>
                      <td>{{ $item->total }}</td>
                    </tr>
                  @endforeach
                  <br><br>
                  <font size="1">
                  <p> H	: hadir</p>
                  <p> A	: tidak hadir</p>
                  <p> I	: izin</p>
                  <p> S	: sakit</p>
                  <p> C	: cuti</p>
                  <p> TL	: tugas</p>
                  <p> IT	: izin terlambat</p>
                  <p> IPC	: izin pulang cepat</p>
              </tbody>
	</table>
</body>
</html>
