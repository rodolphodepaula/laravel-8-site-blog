<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\UsuariosFormRequest;
use Illuminate\Validation\Rule;

class UsuariosController extends Controller
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
            ["titulo" => "Lista de Usuários", "url"=>""]
        ]);

        $listaModelo = User::select('id','name','email', 'autor')->paginate(10);

        return view('admin.usuarios.index', compact('listaMigalhas', 'listaModelo'));
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
    public function store(UsuariosFormRequest $request)
    {
        //dd($request->all());
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        User::create($data);
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
            return User::find($id);
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
    public function update(Request $request, $id)
    {
        $data = $request->all();

        if(isset($data['password']) && $data['password'] != ""){
            $validacao = Validator::make($data, [
            'name' => 'required', 'string', 'max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'password' => 'required', 'string', 'min:8',
            ]);

        }else{
            $validacao = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
           'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)]
            ]);
            unset($data['password']);
        }

        User::find($id)->update($data);
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
        User::find($id)->delete();
       // return redirect()->back();
        return redirect()
                    ->back()
                    ->with(['success' => 'Registro Deletado com Sucesso'])
                    ->withInput();
    }
}