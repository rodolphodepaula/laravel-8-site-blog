<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ArtigosFormRequest;
use App\Models\Artigo;
use App\Models\User;

class ArtigosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaMigalhas = json_encode([
            ["titulo" =>"Admin", "url"=>route('admin')],
            ["titulo" => "Lista de Artigos", "url"=>""]
        ]);
        /* $listaArtigos = json_encode([
            ["id"=>1, "titulo" =>"PHP 00", "descricao"=>"DESENV EM PHP", "autor"=>"Rodolpho de Paula", "data"=>"2017-11-20"],
            ["id"=>2, "titulo" =>"VUEJS", "descricao"=>"DESENV EM VUEJS", "autor"=>"Manuela Braga", "data"=>"2021-09-22"]
        ]); */

        $listaArtigos = Artigo::listaArtigos(5);

        return view('admin.artigos.index', compact('listaMigalhas', 'listaArtigos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArtigosFormRequest $request)
    {
        //dd($request->all());
        $data = $request->all();
        $user = auth()->user();
        $user->artigos()->create($data);
        //Artigo::create($data);
        //return redirect()->back();
        return redirect()
                    ->back()
                    ->with(['success' => 'Registro Criado com Sucesso'])
                    ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Artigo::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArtigosFormRequest $request, $id)
    {
        $data = $request->all();
         $user = auth()->user();
        $user->artigos()->find($id)->update($data);
        //return redirect()->back();
        return redirect()
                    ->back()
                    ->with(['success' => 'Registro Alterado com Sucesso'])
                    ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Artigo::find($id)->delete();
       // return redirect()->back();
        return redirect()
                    ->back()
                    ->with(['success' => 'Registro Deletado com Sucesso'])
                    ->withInput();
    }
}