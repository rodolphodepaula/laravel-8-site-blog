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
    <painel-component titulo="Lista de Artigos">
        <migalhas-component :lista="{{ $listaMigalhas }}"></migalhas-component>
        <tabela-lista-component :titulos="['#','Título', 'Descrição', 'Autor', 'Data']"
            :itens="{{ json_encode($listaArtigos) }}" criar="#criar" detalhe="/admin/artigos/" editar="/admin/artigos/"
            deletar="/admin/artigos/" token="{{ csrf_token() }}" ordem="desc" ordemcol="0" modal="sim">
        </tabela-lista-component>
        <div align="center">
            {{ $listaArtigos }}
        </div>

    </painel-component>
</pagina-component>


{{-- ADICIONAR --}}
<modal-component nome="adicionar" titulo="Adicionar">

    <formulario-component id="formAdicionar" css="" action="{{ route('artigos.store') }}" method="post" enctype=""
        token="{{ csrf_token() }}">
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título"
                value="{{ old('titulo') }}">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição"
                value="{{ old('descricao') }}">
        </div>

        <div class="form-group">
            <label for="addConteudo">Conteúdo</label>
            <ckeditor id="addConteudo" name="conteudo" value="{{ old('conteudo') }}" :config="{
                    toolbar: [
                      [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ]
                    ],
                    height: 200
                  }">
            </ckeditor>

        </div>

        <div class="form-group">
            <label for="data">Data</label>
            {{-- <input type="datetime-local" class="form-control" id="data" name="data" value="{{ old('data') }}"> --}}
            <input type="date" class="form-control" id="data" name="data" value="{{ old('data') }}">
        </div>
    </formulario-component>
    <span slot="botoes">
        <button form="formAdicionar" class="btn btn-info">Adicionar</button>
    </span>

</modal-component>

{{-- EDITAR --}}
<modal-component nome="editar" titulo="Editar">

    <formulario-component id="formEditar" :action="'/admin/artigos/' + $store.state.item.id" method="put"
        enctype="multipart/form-data" token="{{ csrf_token() }}">
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título"
                v-model="$store.state.item.titulo">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição"
                v-model="$store.state.item.descricao">
        </div>
        <div class="form-group">
            <label for="editConteudo">Conteúdo</label>
            <ckeditor id="editConteudo" name="conteudo" v-model="$store.state.item.conteudo" :config="{
                                    toolbar: [
                                      [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ]
                                    ],
                                    height: 200
                                  }">
            </ckeditor>
        </div>

        <div class="form-group">
            <label for="data" :alt="$store.state.item.data">Data</label>
            <input type="date" class="form-control" id="data" name="data" v-model="$store.state.item.data">
        </div>

    </formulario-component>
    <span slot="botoes"><button form="formEditar" class="btn btn-info">Atualizar</button></span>



</modal-component>

{{-- DETALHE --}}
<modal-component nome="detalhe" v-bind:titulo="$store.state.item.titulo">
    <p>@{{$store.state.item.descricao}}</p>
    <p>@{{$store.state.item.conteudo}}</p>
    <p>@{{$store.state.item.data}}</p>

</modal-component>


@endsection