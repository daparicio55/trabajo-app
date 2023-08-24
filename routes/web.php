<?php

use App\Http\Controllers\Administrador\DocenteController;
use App\Http\Controllers\Administrador\EsperaController as AdminEsperaController;
use App\Http\Controllers\Administrador\EstudianteController as AdminEstudianteController;
use App\Http\Controllers\Administrador\ReporteController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmpleoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\PostulacioneController;
use App\Http\Controllers\RubroController;
use App\Http\Controllers\SectoreController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UsersettingController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes(['register'=>false]);
Route::get('/home', function () {
    return Redirect::route('dashboard.index');
});
Route::get('/',[HomeController::class,'index'])->name('home');
Route::resource('/user_dashboard',UserDashboardController::class)->names('user_dashboard');
Route::get('/user_create',[HomeController::class,'create'])->name('user_create');
Route::get('/bussines_create',[HomeController::class,'bussines_create'])->name('bussines_create');
Route::post('/bussines_store',[HomeController::class,'bussines_store'])->name('bussines_store');
Route::post('/',[HomeController::class,'store'])->name('user_store');
Route::get('/empleo/{id}',[HomeController::class,'empleo_show'])->name('empleo');
Route::post('/empleos_search',[HomeController::class,'empleo_search'])->name('empleos_search');
Route::get('/empleo_postular/{id}',[PostulacioneController::class,'postular'])->name('empleo_postular');

//Bolsa USER
Route::resource('/dashboard/settings',UsersettingController::class)->names('dashboard.settings');
Route::get('/dashboard/password',[UsersettingController::class,'edit_password'])->name('dashboard.edit_password');
Route::put('/dashboard/password',[UsersettingController::class,'update_password'])->name('dashboard.update_password');
Route::resource('/dashboard/postulaciones',PostulacioneController::class)->names('dashboard.postulaciones');
Route::resource('/dashboard/ofertas', OfertaController::class)->names('dashboard.ofertas');
//Bolsa ADMINISTRADOR
Route::get('/dashboard/administrador/alumnos/makeaccountmassive',[AdminEstudianteController::class,'makeaccountmassive'])
->name('dashboard.administrador.makeaccountmassive');
Route::resource('/dashboard/administrador/alumnos',AdminEstudianteController::class)->names('dashboard.administrador.alumnos');
Route::post('/dashboard/administrador/alumnos/{id}/email/',[AdminEstudianteController::class,'updateemail'])
->name('dashboard.administrador.updateemail');
Route::get('/dashboard/administrador/alumnos/{id}/make/',[AdminEstudianteController::class,'makeaccount'])
->name('dashboard.administrador.makeaccount');
Route::resource('/dashboard/administrador/docentes',DocenteController::class)->names('dashboard.administrador.docentes');
Route::get('/dashboard/administrador/reportes', [ReporteController::class,'index'])->name('dashboard.administrador.reportes.index');
Route::get('/dashboard/administrador/reportes2', [ReporteController::class,'index2'])->name('dashboard.administrador.reportes.index2');

Route::get('/dashboard/administrador/reportes/empleos',[ReporteController::class,'reporte_empleo'])->name('dashboard.administrador.reportes.reporte_empleo');
Route::get('/dashboard/administrador/reportes/postulaciones',[ReporteController::class,'reporte_postulaciones'])->name('dashboard.administrador.reportes.reporte_postulaciones');
Route::get('/dashboard/administrador/reportes/empleos/excel/{string}',[ReporteController::class,'reporte_empleo_excel'])->name('dashboard.administrador.reportes.reporte_empleo.excel');
Route::get('/dashboard/administrador/reportes/postulaciones/excel/{string}',[ReporteController::class,'reporte_postulaciones_excel'])->name('dashboard.administrador.reportes.reporte_postulaciones.excel');

    //EMPRESAS
Route::resource('/dashboard/administrador/esperas',AdminEsperaController::class)->names('dashboard.administrador.esperas');
Route::post('/dashboard/administrador/empresas/getruc',[EmpresaController::class,'getRuc'])->name('dashboard.administrador.empresas.getruc');
Route::get('/dashboard/administrador/empresas/showwaitings',[EmpresaController::class,'showwaitings'])->name('dashboard.administrador.empresas.showwaitings');
Route::post('/dashboard/administrador/empresas/storewaiting',[EmpresaController::class,'storewaiting'])->name('dashboard.administrador.empresas.storewaiting');
Route::delete('/dashboard/administrador/empresas/destroywaiting/{id}',[EmpresaController::class,'deletewaitings'])->name('dashboard.administrador.empresas.destroywaitings');
Route::post('/dashboard/administrador/empresas/make',[EmpresaController::class,'make'])->name('dashboard.administrador.empresas.make');
Route::resource('/dashboard/administrador/empresas',EmpresaController::class)->names('dashboard.administrador.empresas');
Route::resource('/dashboard/administrador/rubros',RubroController::class)->names('dashboard.administrador.rubros');
Route::resource('/dashboard/administrador/sectores',SectoreController::class)->names('dashboard.administrador.sectores');
//Bolsa EMPRESA
Route::resource('/dashboard/empleos', EmpleoController::class)->names('dashboard.empleos');
Route::resource('/dashboard',DashboardController::class)->names('dashboard');
Route::get('csv',function(){
    return view('dashboard.empleos.test');
})->name('csv.create');
Route::post('csv',[EmpleoController::class,'csv'])->name('csv.store');
//
/* Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); */
Route::post('/dashboard/administrador/alumnos/reset/{token}',[AdminEstudianteController::class,'resetpassword'])
->name('dashboard.administrador.resetpassword');

//Bolsa USER
Route::get('/view',function(){
    return view('emails.postulanteaviso');
});


Route::get('/clear-cache', function () {
    echo Artisan::call('config:cache');
    echo Artisan::call('config:clear');
    echo Artisan::call('cache:clear');
    echo Artisan::call('route:clear');

    /* php artisan config:clear
    php artisan cache:clear
    php artisan config:cache
    composer dump-autoload */

 })->middleware('auth');


 Route::get('/api/getdatos/{dni}',[ApiController::class,'getdatos'])->name('api.getdatos');