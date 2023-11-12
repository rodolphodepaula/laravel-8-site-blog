@extends('layouts.app')

@section('content')
<pagina-component tamanho="12">
    <painel-component>
        <h2 align="center">{{ $artigo->titulo }}</h2>
        <h4 align="center">{{ $artigo->descricao }}</h4>
        <p>
            {!! $artigo->conteudo !!}
        </p>
        <p align="center">
            <small>Por: {{ $artigo->user->name}} - {{ date('d/m/Y', strtotime($artigo->data))}}</small>

        </p>

    </painel-component>
</pagina-component>


@endsection