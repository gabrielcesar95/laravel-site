@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <div class="row px-3">
        <h1 class="mr-auto">Usuários</h1>
    </div>
@stop
{{-- TODO: Concluído - criação do form de filtro com o package Aire --}}
{{-- TODO: Concluído - esboço do visual da tabela --}}
{{-- TODO: Aquisição dos dados por ajax no carregamento do form (controller) --}}
{{-- TODO: Aquisição dos dados por ajax na filtragem --}}
{{-- TODO: Fazer filtro por ajax conforme: https://www.webslesson.info/2018/09/laravel-pagination-using-ajax.html --}}
@section('content')
    <section>
        <div class="accordion" id="filters">
            <div id="filters-accordion" class="collapse mb-1" aria-labelledby="filters-heading" data-parent="#filters">
                <div class="col-12 p-0">
                    {{ Aire::open()->route('admin.user.search')->autoComplete('off')->method('get')->data('search-form', true) }}
                    <div class="form-row">
                        {{ Aire::input('name[value]', 'Nome')->groupClass('col-md-4 col-lg-3') }}
                        {{ Aire::hidden('name[operator]')->value('LIKE') }}
                        {{ Aire::input('email[value]', 'E-Mail')->groupClass('col-md-4 col-lg-3')->data('operator', 'LIKE') }}
                        {{ Aire::hidden('email[operator]')->value('LIKE') }}
                        {{ Aire::select(['1' => 'Ativo', '0' => 'Inativo'], 'active', 'Situação')->groupClass('col-md-2')->value(1) }}
                        <div class="col-md-1 d-flex mt-sm-2">
                            {{ Aire::submit()->class('w-100 d-flex mt-auto align-items-center justify-content-center')->labelHtml('<i class="material material-search"></i><span class="sr-only">Buscar</span>')->style('height: calc(1.6em + 0.75rem + 2px);') }}
                        </div>
                    </div>
                    {{ Aire::close() }}
                </div>
            </div>
        </div>
    </section>

    <section class="mt-2">
        <div class="btn-toolbar mb-1" role="toolbar" aria-label="Ações Disponíveis">
            <button class="btn btn-info text-white d-flex mb-auto" type="button" data-toggle="collapse" data-target="#filters-accordion" aria-expanded="true" aria-controls="filters-accordion">
                Filtros
            </button>

            <button class="btn btn-success ml-auto d-flex align-items-center">
                <i class="material material-add mr-1"></i> Novo Usuário
            </button>
        </div>
        <div id="main-list">
            @include('admin.user.index_list')
        </div>
    </section>
@stop

@push('js')

@endpush
