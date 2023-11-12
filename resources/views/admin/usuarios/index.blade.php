@extends('layouts.app')

@section('content')
<pagina-component tamanho="12">

    @if($errors->all())
    @foreach($errors->all() as $key => $value)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Atenção !</strong> {{$value}}.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endforeach
    @endif
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{Session::get('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <painel-component titulo="Lista de Usuários">
        <migalhas-component :lista="{{ $listaMigalhas }}"></migalhas-component>
        <tabela-lista-component :titulos="['#','Nome', 'E-mail', 'Autor', 'Admin']" :itens="{{ json_encode($listaModelo) }}"
            criar="#criar" detalhe="/admin/usuarios/" editar="/admin/usuarios/" deletar="/admin/usuarios/"
            token="{{ csrf_token() }}" ordem="asc" ordemcol="1" modal="sim">
        </tabela-lista-component>
        <div align="center">
            {{ $listaModelo }}
        </div>

    </painel-component>
</pagina-component>


{{-- ADICIONAR --}}
<modal-component nome="adicionar" titulo="Adicionar">

    <formulario-component id="formAdicionar" css="" action="{{ route('usuarios.store') }}" method="post" enctype=""
        token="{{ csrf_token() }}">
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nome" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail"
                value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="autor">Autor</label>
            <select name="autor" id="autor" class="form-control">
                <option {{ (old('autor') && old('autor') == 'N' ? 'selected' : '' )}} value="N">Não</option>
                <option {{ (old('autor') && old('autor') == 'S' ? 'selected' : '' )}} value="S">Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="admin">Admin</label>
            <select name="admin" id="admin" class="form-control">
                <option {{ (old('admin') && old('admin') == 'N' ? 'selected' : '' )}} value="N">Não</option>
                <option {{ (old('admin') && old('admin') == 'S' ? 'selected' : '' )}} value="S">Sim</option>
            </select>
        </div>

        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
        </div>
    </formulario-component>
    <span slot="botoes">
        <button form="formAdicionar" class="btn btn-info">Adicionar</button>
    </span>

</modal-component>

{{-- EDITAR --}}
<modal-component nome="editar" titulo="Editar">

    <formulario-component id="formEditar" :action="'/admin/usuarios/' + $store.state.item.id" method="put"
        enctype="multipart/form-data" token="{{ csrf_token() }}">
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nome"
                v-model="$store.state.item.name">
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="E-mail"
                v-model="$store.state.item.email">
        </div>

        <div class="form-group">
            <label for="autor">Autor</label>
            <select name="autor" id="autor" class="form-control" v-model="$store.state.item.autor">
                <option value="N">Não</option>
                <option value="S">Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="admin">Administrador</label>
            <select name="admin" id="admin" class="form-control" v-model="$store.state.item.admin">
                <option value="N">Não</option>
                <option value="S">Sim</option>
            </select>
        </div>

        <div class="form-group">
            <label for="password" :alt="$store.state.item.password">Senha</label>
            <input type="password" class="form-control" id="password" name="password"
                v-model="$store.state.item.password">
        </div>

    </formulario-component>
    <span slot="botoes"><button form="formEditar" class="btn btn-info">Atualizar</button></span>



</modal-component>

{{-- DETALHE --}}
<modal-component nome="detalhe" v-bind:titulo="$store.state.item.name">
    <p>E-mail: @{{$store.state.item.email}}</p>
    <p>Autor: @{{($store.state.item.autor == 'S') ? 'Sim' : 'Não'}}</p>
</modal-component>


@endsection