<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ArtigosController;
use App\Http\Controllers\Admin\UsuariosController;
use App\Http\Controllers\Admin\AutoresController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Models\Artigo;


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

Route::get('/', function (Request $request) {



    if(isset($request->busca) && $request->busca != ""){

        $busca = $request->busca;
        $lista = Artigo::listaArtigosSite(3,  $busca);

    }else{
        $lista = Artigo::listaArtigosSite(3);
        $busca = "";
    }
    /* return redirect()
                    ->route('home')
                    ->with(['success' => ''])
                    ->withInput(); */

    return view('site', compact('lista', 'busca'));
})->name('site');

Route::get('/artigo/{id}/{titulo?}', function($id){
   $artigo = Artigo::find($id);
   if($artigo){
       return view('artigo', compact('artigo'));
   }
   return redirect()->route('site');
})->name('artigo');

Auth::routes();

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin')->middleware('can:autor');

//middleware - Rotas autenticadas
// prefix -> exibe na URL
//namespace -> Não precisa incluir o caminho do controller
Route::middleware('auth')->prefix('admin')->group(function () {

    Route::resource('artigos', ArtigosController::class)->middleware('can:autor');
    Route::resource('usuarios', UsuariosController::class)->middleware('can:eAdmin');
    Route::resource('autores', AutoresController::class)->middleware('can:eAdmin');
    Route::resource('adm', AdminController::class)->middleware('can:eAdmin');


});