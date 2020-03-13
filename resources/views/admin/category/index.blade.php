@extends('adminlte::page')

@section('title', 'Categorias')

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
                    <form action="{{ route('admin.category.search') }}" method="GET" autocomplete="off" data-search-form="true">
                        <div class="form-row">
                            <div class="col-md-4 col-lg-3">
                                <label for="name[value]">Nome</label>
                                <input type="text" class="form-control" name="name[value]" id="name[value]">
                            </div>
                            <input type="hidden" class="form-control" name="name[operator]" value="LIKE" id="name[operator]">
                            <div class="col-md-1 d-flex mt-2 mt-md-0">
                                <button class="w-100 d-flex mt-auto align-items-center justify-content-center btn btn-primary" type="submit" style="height: calc(1.6em + 0.75rem + 2px);">
                                    <i class="mdi mdi-magnify"></i>
                                    <span class="sr-only">Buscar</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-2">
        <div class="btn-toolbar mb-1" role="toolbar" aria-label="Ações Disponíveis">
            <button class="btn btn-info text-white col-12 col-md-auto d-flex mb-1 mb-md-auto" type="button" data-toggle="collapse" data-target="#filters-accordion" aria-expanded="true" aria-controls="filters-accordion">
                <i class="mdi mdi-filter mr-1"></i> Filtros
            </button>
            @can('role@create')
                <button class="btn btn-success ml-auto d-flex align-items-center col-12 col-md-auto" data-trigger-popup="{{ route('admin.category.create') }}">
                    <i class="mdi mdi-plus-circle mr-1"></i> Nova Categoria
                </button>
            @endcan
        </div>
        <div id="main-list">
            @include('admin.category.index_list')
        </div>
    </section>
@stop

@push('js')
    <script>

    </script>
@endpush
