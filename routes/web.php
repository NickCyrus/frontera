<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\contratosController;
use App\Http\Controllers\logUserController;
use App\Http\Controllers\modulesController;
use App\Http\Controllers\perfilController;
use App\Http\Controllers\perfilesController;
use App\Http\Controllers\personalController;
use App\Http\Controllers\usuariosController;
use App\Http\Controllers\equiposController;
use App\Http\Controllers\itemsController;
use App\Http\Controllers\materialesController;
use App\Models\quotesModel;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade\Pdf;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('app');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 

Auth::routes();

*/
Route::post('login', [LoginController::class, 'login']);
Route::match(['get', 'post'], 'logout', [LoginController::class, 'logout'])->name('logout');

Route::get('login', function () {
    return view('login');
})->name('login');

Route::get('errorAccess',function(){
    return view('access-invalid');
})->name('errorAccess');

Route::group(['middleware' => ['auth'] ], function () {
    Route::get('/', function () { return view('dashboard'); });
    Route::get('dashboard', function () { return view('dashboard'); })->name('home');
    Route::get('profile', [perfilController::class , 'index']  )->name('profile');
    Route::get('profile/log-access', [perfilController::class , 'logaccess']  )->name('logaccess');
    Route::post('profile/changepassword', [perfilController::class , 'changepassword']  )->name('profile.changepassword');
    Route::get('logsusers', [logUserController::class, 'index'])->name('logsusers');


    //modules
    Route::get('modules', [modulesController::class,'index'])->name('modules');
    Route::post('modules/add', [modulesController::class,'add'])->name('modules.add');
    Route::post('modules/{id}/edit', [modulesController::class,'edit'])->name('modules.edit');
    Route::get('modules/{id}/delete', [modulesController::class,'delete'])->name('modules.delete');
    Route::post('modules/save', [modulesController::class,'save'])->name('modules.save');

    //Pefiles
    Route::get('perfiles', [perfilesController::class,'index'])->name('perfiles');
    Route::post('perfiles/add', [perfilesController::class,'add'])->name('perfiles.add');
    Route::post('perfiles/{id}/edit', [perfilesController::class,'edit'])->name('perfiles.edit');
    Route::get('perfiles/{id}/delete', [perfilesController::class,'delete'])->name('perfiles.delete');
    Route::post('perfiles/save', [perfilesController::class,'save'])->name('perfiles.save');

    // Personal
    Route::get('personal', [personalController::class,'index'])->name('personal');
    Route::post('personal/add', [personalController::class,'add'])->name('personal.add');
    Route::post('personal/{id}/edit', [personalController::class,'edit'])->name('personal.edit');
    Route::get('personal/{id}/delete', [personalController::class,'delete'])->name('personal.delete');
    Route::post('personal/save', [personalController::class,'save'])->name('personal.save');

    // Usuarios
    Route::get('usuarios', [usuariosController::class,'index'])->name('usuarios');
    Route::post('usuarios/add', [usuariosController::class,'add'])->name('usuarios.add');
    Route::post('usuarios/{id}/edit', [usuariosController::class,'edit'])->name('usuarios.edit');
    Route::get('usuarios/{id}/delete', [usuariosController::class,'delete'])->name('usuarios.delete');
    Route::post('usuarios/save', [usuariosController::class,'save'])->name('usuarios.save');

    // Equipos
    Route::get('equipos', [ equiposController::class , 'index'])->name('equipos');
    Route::post('equipos/add', [equiposController::class,'add'])->name('equipos.add');
    Route::post('equipos/{id}/edit', [equiposController::class,'edit'])->name('equipos.edit');
    Route::get('equipos/{id}/delete', [equiposController::class,'delete'])->name('equipos.delete');
    Route::post('equipos/save', [equiposController::class,'save'])->name('equipos.save');

    // Materiales
    Route::get('materiales', [ materialesController::class , 'index'])->name('materiales');
    Route::post('materiales/add', [materialesController::class,'add'])->name('materiales.add');
    Route::post('materiales/{id}/edit', [materialesController::class,'edit'])->name('materiales.edit');
    Route::get('materiales/{id}/delete', [materialesController::class,'delete'])->name('materiales.delete');
    Route::post('materiales/save', [materialesController::class,'save'])->name('materiales.save');
 
    // Items contratos

    Route::get('items', [ itemsController::class , 'index'])->name('items');
    Route::post('items/add', [itemsController::class,'add'])->name('items.add');
    Route::post('items/{id}/edit', [itemsController::class,'edit'])->name('items.edit');
    Route::get('items/{id}/delete', [itemsController::class,'delete'])->name('items.delete');
    Route::post('items/save', [itemsController::class,'save'])->name('items.save');

    // Contratos
    Route::get('contratos', [ contratosController::class , 'index'])->name('contratos');
    Route::post('contratos/add', [contratosController::class,'add'])->name('contratos.add');
    Route::post('contratos/{id}/edit', [contratosController::class,'edit'])->name('contratos.edit');
    Route::get('contratos/{id}/delete', [contratosController::class,'delete'])->name('contratos.delete');
    Route::post('contratos/save', [contratosController::class,'save'])->name('contratos.save');

    // Contratos Ajax
    Route::match(['get', 'post'], 'contratos/ajax/{opc}', [ contratosController::class , 'ajax'])->name('contratos.ajax');

    // Contratos Item
    Route::get('contratos/{id}/items', [contratosController::class,'items'])->name('contratos.items');
    Route::get('contratos/{id}/items/add', [contratosController::class,'add_item'])->name('contratos.items.add'); 
    Route::get('contratos/{id}/items/{item}/delete', [contratosController::class,'delete_item'])->name('contratos.items.delete'); 
    Route::post('contratos/{id}/items/save', [contratosController::class,'items_save'])->name('contratos.items.save');
    
    // Contratos cotizaciones
    Route::get('contratos/{id}/cotizaciones', [contratosController::class,'cotizaciones'])->name('contratos.cotizaciones');
    Route::post('contratos/{id}/cotizaciones/add', [contratosController::class,'add_cotizacion'])->name('contratos.cotizaciones.add');
    Route::post('contratos/{id}/cotizaciones/pdf', [contratosController::class,'showpdf'])->name('contratos.cotizaciones.pdf');

    Route::post('contratos/{id}/cotizaciones/{item}/edit', [contratosController::class,'edit_cotizacion'])->name('contratos.cotizaciones.edit');
    Route::get('contratos/{id}/cotizaciones/{item}/items', [contratosController::class,'items_cotizacion'])->name('contratos.cotizaciones.items');
    Route::get('contratos/{id}/cotizaciones/{item}/delete', [contratosController::class,'delete_cotizacion'])->name('contratos.cotizaciones.delete');
    Route::post('contratos/{id}/cotizaciones/save', [contratosController::class,'save_cotizaciones'])->name('contratos.cotizaciones.save');

    Route::post('contratos/{id}/cotizaciones/{item}/item/{iditem?}', [contratosController::class,'item_cotizacion'])->name('contratos.cotizaciones.item.add');
    Route::get('contratos/{id}/cotizaciones/{item}/item/{iditem?}/delete', [contratosController::class,'itemdelete_cotizacion'])->name('contratos.cotizaciones.item.delete');
    
    Route::post('contratos/{id}/cotizaciones/{item}/item/{iditem?}/save', [contratosController::class,'itemsave_cotizacion'])->name('contratos.cotizaciones.item.save');

    Route::post('contratos/cotizaciones/{item}/send-mail', [contratosController::class,'sendmail_cotizacion'])->name('contratos.cotizaciones.sendmail');

    Route::get('pdf/{id}', function($id){

        $pdf = app('dompdf.wrapper');

        list($idCot , $basura) =  explode('|', base64_decode(base64_decode($id)) );

        $cotizacion = quotesModel::where('id',$idCot)->first();
         
        $pdf->setPaper('letter', 'landscape')
        ->loadView('pdf.cotpresentada', ['cotizacion'=>$cotizacion]);
        return $pdf->stream('archivo.pdf');

    })->name('cotizacion.pdf.view');

    Route::get('pdf/{id}/download', function($id){

        $pdf = app('dompdf.wrapper');

        list($idCot , $basura) =  explode('|', base64_decode(base64_decode($id)) );

        $cotizacion = quotesModel::where('id',$idCot)->first();
         
        $pdf->setPaper('letter', 'landscape')
        ->loadView('pdf.cotpresentada', ['cotizacion'=>$cotizacion]);
        return $pdf->download("Presupuesto N° {$cotizacion->id}.pdf");

    })->name('cotizacion.pdf.download');
 

});