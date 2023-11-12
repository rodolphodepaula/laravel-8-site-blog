@extends('layouts.app')

@section('content')
<pagina-component tamanho="12">
    <painel-component titulo="Artigos">

        <p>
            <form class="form-inline" action="{{ route('site') }}" method="get">
                <div class="input-group input-group-sm">
                    <input type="search" class="form-control form-control-navbar" name="busca" placeholder="Buscar"
                        value="{{ isset($busca) ? $busca : "" }}">
                    <div class="input-group-append">
                        <button class="btn btn-navbar">Buscar</button>
                    </div>
                </div>

            </form>

        </p>


        <div class="row">
            @foreach($lista as $key => $value)
            <artigo-card-component titulo="{{Str::limit($value->titulo, 20, '...')}}"
                descricao="{{ Str::limit($value->descricao, 50, '...') }}"
                link="{{ route('artigo', [$value->id, Str::slug($value->titulo)]) }}"
                imagem="https://www.layoutit.com/img/people-q-c-600-200-1.jpg" data="{{ $value->data }}"
                autor="{{ $value->autor }}" sm="6" md="4">
            </artigo-card-component>
            @endforeach


        </div>
        <div align="center">
            <p>
                {{ $lista }}
            </p>
        </div>

    </painel-component>
</pagina-component>


@endsection
