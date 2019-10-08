@extends('adminlte::page')

@section('title', 'Comentários')

@section('content_header')
    <div class="row px-3">
        <h1 class="mr-auto">@yield('title')</h1>
    </div>
@stop

@section('content')
    <section>
        <div class="accordion" id="filters">
            <div id="filters-accordion" class="collapse mb-1" aria-labelledby="filters-heading" data-parent="#filters">
                <div class="col-12 p-0">
                    {{ Aire::open()->route('admin.comment.search')->autoComplete('off')->method('get')->data('search-form', true) }}
                    <div class="form-row">
                        {{ Aire::input('user__name[value]', 'Autor')->groupClass('col-md-4 col-lg-3') }}
                        {{ Aire::hidden('user__name[operator]')->value('LIKE') }}

                        {{ Aire::input('approved[value]', 'Situação')->type('checkbox')->data('toggle', 'toggle')->data('style', 'w-100 mt-auto')->data('on', 'Aprovado')->data('off', 'Não Aprovado')->data('onstyle', 'primary')->data('offstyle', 'light')->value(1)->groupClass('col-md-3') }}
                        {{ Aire::hidden('approved[operator]')->value('checked') }}

                        <div class="col-md-1 d-flex mt-2 mt-md-0">
                            {{ Aire::submit()->class('w-100 d-flex mt-auto align-items-center justify-content-center')->labelHtml('<i class="mdi mdi-magnify"></i><span class="sr-only">Buscar</span>')->style('height: calc(1.6em + 0.75rem + 2px);') }}
                        </div>
                    </div>

                    {{ Aire::close() }}
                </div>
            </div>
        </div>
    </section>

    <section class="mt-2">
        <div class="btn-toolbar mb-1" role="toolbar" aria-label="Ações Disponíveis">
            <button class="btn btn-info text-white col-12 col-md-auto d-flex mb-1 mb-md-auto" type="button" data-toggle="collapse" data-target="#filters-accordion" aria-expanded="true" aria-controls="filters-accordion">
                <i class="mdi mdi-filter mr-1"></i> Filtros
            </button>
        </div>
        <div id="main-list">
            @include('admin.comment.index_list')
        </div>
    </section>
@stop

@push('js')
    <script>

    </script>
@endpush
