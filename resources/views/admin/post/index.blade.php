@extends('adminlte::page')

@section('title', 'Postagens')

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
                    {{ Aire::open()->route('admin.post.search')->autoComplete('off')->method('get')->data('search-form', true) }}
                    <div class="form-row">
                        {{ Aire::input('name[value]', 'Nome')->groupClass('col-md-4 col-lg-3') }}
                        {{ Aire::hidden('name[operator]')->value('LIKE') }}
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
            @can('post@create')
                <button class="btn btn-success ml-auto d-flex align-items-center col-12 col-md-auto" data-trigger-popup="{{ route('admin.post.create') }}" data-popup-size="lg">
                    <i class="mdi mdi-plus-circle mr-1"></i> Nova Postagem
                </button>
            @endcan
        </div>
        <div id="main-list">
            @include('admin.post.index_list')
        </div>
    </section>
@stop

@push('js')
    <script>

    </script>
@endpush
