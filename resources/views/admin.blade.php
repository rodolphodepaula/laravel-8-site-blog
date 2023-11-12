@extends('layouts.app')

@section('content')
<pagina-component tamanho="10">
    <painel-component titulo="Dashboard">
        <migalhas-component :lista="{{ $listaMigalhas }}"></migalhas-component>
        <div class="row">
            @can('autor')
            <div class="col-md-3">
                <caixa-component qtd="{{ $totalArtigos }}" titulo="Artigos" url="{{ route('artigos.index') }}"
                    cor="#28a745" icone="ion ion-pie-graph"></caixa-component>
            </div>
            @endcan
            @can('eAdmin')
            <div class="col-md-3">
                <caixa-component qtd="{{ $totalUsuarios }}" titulo="Usuários" url="{{ route('usuarios.index') }}"
                    cor="#17a2b8" icone="ion ion-person-stalker">
                </caixa-component>
            </div>
            @endcan
            @can('eAdmin')
            <div class="col-md-3">
                <caixa-component qtd="{{ $totalAutores }}" titulo="Autores" url="{{ route('autores.index') }}"
                    cor="#ffc107" icone="ion ion-person">
                </caixa-component>
            </div>
            @endcan
            @can('eAdmin')
            <div class="col-md-3">
                <caixa-component qtd="{{ $totalAdmin }}" titulo="Administradores" url="{{ route('adm.index') }}"
                    cor="#dc3545" icone="ion ion-person-add">
                </caixa-component>
            </div>
            @endcan

        </div>

    </painel-component>
</pagina-component>


@endsection