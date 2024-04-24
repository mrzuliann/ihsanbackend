<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\PresensiHourController;
use App\Http\Controllers\HolidaydateController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\PresensiHourDayController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginSessionController;
use App\Http\Controllers\SubLocationController;
use App\Http\Controllers\SubLocationUserController;
use App\Http\Controllers\PengajuanCutiController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/privacy', function () {
    return view('privacy');
});

Route::get('/foo', function () {
    Artisan::call('storage:link');
});

Auth::routes();

Route::middleware('role:1')->group(function () {
    // Auth::routes();
    // User
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
    Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
    Route::get('user/data',[UserController::class,'dataTable'])->name('user.data');
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/create-user', [App\Http\Controllers\UserController::class, 'create'])->name('user-create');
    Route::post('/store-user', [App\Http\Controllers\UserController::class, 'store'])->name('user-store');
    Route::post('/update-user', [App\Http\Controllers\UserController::class, 'update'])->name('user-update');
    Route::get('/import-user', [App\Http\Controllers\UserController::class, 'import'])->name('user-import');
    Route::get('/file-import', [UserController::class, 'importView'])->name('import-view');
    Route::post('/importuser', [UserController::class, 'import'])->name('importuser');
    Route::get('/downloadimport', [UserController::class, 'downloadfimport'])->name('downloadimport');
    Route::get('/export-users', [UserController::class, 'exportUsers'])->name('export');
    Route::resource('user', UserController::class);
    // School
    Route::get('/import-school', [App\Http\Controllers\SchoolController::class, 'import'])->name('school-import');
    Route::get('/file-import', [SchoolController::class, 'importView'])->name('import-view');
    Route::post('/import', [SchoolController::class, 'import'])->name('import');
    Route::get('/export-schools', [SchoolController::class, 'exportSchools'])->name('exportschools');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/school', [App\Http\Controllers\SchoolController::class, 'index'])->name('school');
    Route::get('/downloadimportsekolah',[SchoolController::class, 'downloadfimport'])->name('downloadimportsekolah');
    Route::get('/create-school', [App\Http\Controllers\SchoolController::class, 'create'])->name('school-create');
    Route::post('/update-school', 'SchoolController@update')->name('school-update');
    Route::post('/store-school', [App\Http\Controllers\SchoolController::class, 'store'])->name('school-store');
    Route::resource('school', SchoolController::class);

     // Sub School
     Route::get('/import-school', [App\Http\Controllers\SubLocationController::class, 'import'])->name('school-import');
     Route::get('/file-import', [SubLocationController::class, 'importView'])->name('import-view');
     Route::post('/import', [SubLocationController::class, 'import'])->name('import');
     Route::get('/export-schools', [SubLocationController::class, 'exportSchools'])->name('exportschools');
     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
     Route::get('/subloc-school', [App\Http\Controllers\SubLocationController::class, 'index'])->name('subloc-school');
     Route::get('/downloadimportsekolah',[SubLocationController::class, 'downloadfimport'])->name('downloadimportsekolah');
     Route::get('/create-subloc-school', [App\Http\Controllers\SubLocationController::class, 'create'])->name('subloc-school-create');
     Route::post('/update-subloc-school', 'SubLocationController@update')->name('subloc-school-update');
     Route::post('/store-school', [App\Http\Controllers\SubLocationController::class, 'store'])->name('school-store');
     Route::resource('subloc-school', SubLocationController::class);

       // Pengajuan Cuti
    Route::get('/import-school', [App\Http\Controllers\PengajuanCutiController::class, 'import'])->name('school-import');
    Route::get('/file-import', [PengajuanCutiController::class, 'importView'])->name('import-view');
    Route::post('/import', [PengajuanCutiController::class, 'import'])->name('import');
    Route::get('/export-schools', [PengajuanCutiController::class, 'exportSchools'])->name('exportschools');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/pengajuancuti', [App\Http\Controllers\PengajuanCutiController::class, 'index'])->name('pengajuancuti');
    Route::get('/downloadimportsekolah', [PengajuanCutiController::class, 'downloadfimport'])->name('downloadimportsekolah');
    Route::get('/downloadpengajuancuti', [PengajuanCutiController::class, 'downloadlampiran'])->name('downloadpengajuancuti');
    Route::get('/create-pengajuancuti', [App\Http\Controllers\PengajuanCutiController::class, 'create'])->name('pengajuancuti-create');
    Route::post('/update-pengajuancuti', 'PengajuanCutiController@update')->name('pengajuancuti-update');
    Route::post('/store-pengajuancuti', [App\Http\Controllers\PengajuanCutiController::class, 'store'])->name('store-pengajuancuti');
    Route::get('pengajuancuti/data', [PengajuanCutiController::class, 'dataTable'])->name('pengajuancuti.data');
    Route::resource('pengajuancuti', PengajuanCutiController::class);

      // Jam Presensi
      Route::get('/import-presensihour', [App\Http\Controllers\PresensihourController::class, 'import'])->name('presensihour-import');
      Route::get('/file-importjam', [PresensihourController::class, 'importView'])->name('import-view');
      Route::post('/importjam', [PresensihourController::class, 'import'])->name('importjam');
      Route::get('/export-presensihours', [PresensihourController::class, 'exportpresensihours'])->name('exportjam');
      Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
      Route::get('/presensihour', [App\Http\Controllers\PresensihourController::class, 'index'])->name('presensihour');
      Route::get('/create-presensihour', [App\Http\Controllers\PresensihourController::class, 'create'])->name('presensihour-create');
      Route::post('/update-presensihour', 'PresensihourController@update')->name('presensihour-update');
      Route::post('/store-presensihour', [App\Http\Controllers\PresensihourController::class, 'store'])->name('presensihour-store');
      Route::resource('presensihour', PresensihourController::class);

      // Hari Libur
      Route::get('/import-presensiholiday', [App\Http\Controllers\HolidaydateController::class, 'import'])->name('presensiholiday-import');
      Route::get('/file-importholidays', [HolidaydateController::class, 'importView'])->name('import-view');
      Route::post('/importholidays', [HolidaydateController::class, 'import'])->name('importholidays');
      Route::get('/export-presensiholidays', [HolidaydateController::class, 'exportholidays'])->name('exportholidays');
      Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
      Route::get('/presensiholiday', [App\Http\Controllers\HolidaydateController::class, 'index'])->name('presensiholiday');
      Route::get('/downloadimportholidays',[HolidaydateController::class, 'downloadfimport'])->name('downloadimportholiday');
      Route::get('/create-presensiholiday', [App\Http\Controllers\HolidaydateController::class, 'create'])->name('presensiholiday-create');
      Route::get('/presensiholiday/{id}/edit', [App\Http\Controllers\HolidaydateController::class, 'edit'])->name('presensiholiday.edit');
     // Route::post('/update-holidaydate', [App\Http\Controllers\HolidaydateController::class, 'update'])->name('presensiholiday-update');
     Route::post('/update-presensiholiday/{id}', [HolidaydateController::class, 'update'])->name('presensiholiday-update');
     Route::post('/store-presensiholiday', [App\Http\Controllers\HolidaydateController::class, 'store'])->name('presensiholiday-store');
      Route::delete('/presensiholiday/{presensiholiday}', [App\Http\Controllers\HolidaydateController::class, 'destroy'])->name('presensiholiday.destroy');

      //role
      Route::get('/create-role', [App\Http\Controllers\RoleController::class, 'create'])->name('role-create');
      Route::resource('role', RoleController::class);

      // Presensi Shift
      Route::get('/import-presensishift', [App\Http\Controllers\ShiftController::class, 'import'])->name('presensishift-import');
      Route::get('/file-importholidays', [ShiftController::class, 'importView'])->name('import-view');
      Route::post('/importshift', [ShiftController::class, 'import'])->name('importshift');
      Route::get('/export-presensishift', [ShiftController::class, 'exportshift'])->name('exportshift');
      Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
      Route::get('/presensishift', [App\Http\Controllers\ShiftController::class, 'index'])->name('presensishift');
      Route::get('/downloadimportshift',[ShiftController::class, 'downloadfimport'])->name('downloadimportshift');
      Route::get('/create-presensishift', [App\Http\Controllers\ShiftController::class, 'create'])->name('presensishift-create');
      Route::get('/presensishift/{id}/edit', [App\Http\Controllers\ShiftController::class, 'edit'])->name('presensishift.edit');
      Route::post('/update-presensishift/{shift_id}', [ShiftController::class, 'update'])->name('presensishift-update');
      Route::post('/store-presensishift', [App\Http\Controllers\ShiftController::class, 'store'])->name('presensishift-store');
      Route::delete('/presensishift/{presensishift}', [App\Http\Controllers\ShiftController::class, 'destroy'])->name('presensishift.destroy');
    Route::resource('presensishift', ShiftController::class);

     // Presensi Hour Day
     Route::get('/import-presensihourday', [App\Http\Controllers\PresensiHourDayController::class, 'import'])->name('presensihourday-import');
     Route::get('/file-importholidays', [PresensiHourDayController::class, 'importView'])->name('import-view');
     Route::post('/importhourday', [PresensiHourDayController::class, 'import'])->name('importhourday');
     Route::get('/export-presensihourday', [PresensiHourDayController::class, 'exporthourdays'])->name('exportpresensihourday');
     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
     Route::get('/presensihourday', [App\Http\Controllers\PresensiHourDayController::class, 'index'])->name('presensihourday.index');
     Route::get('/downloadimporthourday',[PresensiHourDayController::class, 'downloadfimport'])->name('downloadimportpresensihhourday');
     Route::get('/create-presensihourday', [App\Http\Controllers\PresensiHourDayController::class, 'create'])->name('presensihourday-create');
     Route::get('/presensihourday/{id}/edit', [App\Http\Controllers\PresensiHourDayController::class, 'edit'])->name('presensihourday.edit');
    // Route::post('/update-presensihourday', 'PresensiHourDayController@update')->name('presensihourday-update');
    // Route::post('/update-presensihourday', [PresensihourDayController::class, 'update'])->name('presensihourday-update');
    Route::post('/update-presensihourday/{phd_id}', [PresensihourDayController::class, 'update'])->name('presensihourday-update');

    //Route::post('/update-presensihourday/{id}', [PresensiHourDayController::class, 'update'])->name('presensihourday.update');


     Route::post('/store-presensihourday', [App\Http\Controllers\PresensiHourDayController::class, 'store'])->name('presensihourday-store');
     Route::delete('/presensihourday/{presensihourday}', [App\Http\Controllers\PresensiHourDayController::class, 'destroy'])->name('presensihourday.destroy');
    //Route::resource('presensihourday', PresensiHourDayController::class);


    // Pengumuman
    Route::get('/pengumuman', [App\Http\Controllers\PengumumanController::class, 'index'])->name('[pengumuman]');
    Route::get('/create-pengumuman', [App\Http\Controllers\PengumumanController::class, 'create'])->name('pengumuman-create');
    Route::post('/update-pengumuman', [App\Http\Controllers\PengumumanController::class, 'update'])->name('pengumuman-update');
    Route::post('/pengumuman/update/{id}', 'PengumumanController@update')->name('pengumuman-update');

    Route::post('/store-pengumuman', [App\Http\Controllers\PengumumanController::class, 'store'])->name('pengumuman-store');
    Route::resource('pengumuman', PengumumanController::class);
    //Report
    Route::get('/report/perbulan', [App\Http\Controllers\ReportController::class, 'index'])->name('report');
    Route::get('/report/perhari', [App\Http\Controllers\ReportController::class, 'perhari'])->name('report.perhari');
    Route::get('/report/detail/{id}', [App\Http\Controllers\ReportController::class, 'detail'])->name('report.detail');
    Route::get('/reportpdf', [App\Http\Controllers\ReportController::class, 'report_pdf'])->name('reportpdf');
    Route::resource('report', ReportController::class);
    //Event
    Route::get('/create-event', [App\Http\Controllers\EventController::class, 'create'])->name('event-create');
    Route::post('/store-event', [App\Http\Controllers\EventController::class, 'store'])->name('event-store');
    Route::resource('event', EventController::class);



    //Galery
    Route::post('/store-galery', [App\Http\Controllers\GaleryController::class, 'store'])->name('galery-store');
    Route::get('/create-galery', [App\Http\Controllers\GaleryController::class, 'create'])->name('galery-create');
    Route::resource('galery', GaleryController::class);
     //Galery
     Route::post('/store-loginsession', [App\Http\Controllers\LoginSessionController::class, 'store'])->name('loginsession-store');
     Route::get('/create-loginsession', [App\Http\Controllers\LoginSessionController::class, 'create'])->name('loginsession-create');
     Route::resource('loginsession', LoginSessionController::class);
    //Reset Password
    Route::resource('reset', ResetPasswordController::class);
    Route::get('holidaydate', [HolidaydateController::class, 'getCURL'])->name('holidaydate');
    Route::get('holiday', [HolidaydateController::class, 'apiWithKey'])->name('apiWithKey');
});

// Route::middleware('role:2')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/report/perbulan', [App\Http\Controllers\ReportController::class, 'index'])->name('report');
    Route::get('/report/perhari', [App\Http\Controllers\ReportController::class, 'perhari'])->name('report.perhari');
    Route::get('/report/detail/{id}', [App\Http\Controllers\ReportController::class, 'detail'])->name('report.detail');
    Route::get('/reportpdf', [App\Http\Controllers\ReportController::class, 'report_pdf'])->name('reportpdf');
    Route::resource('report', ReportController::class);
// });
