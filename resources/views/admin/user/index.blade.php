@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <div class="row px-3">
        <h1 class="mr-auto">Usuários</h1>
        <button class="btn btn-info text-white d-flex mb-auto" type="button" data-toggle="collapse" data-target="#filters-accordion" aria-expanded="true" aria-controls="filters-accordion">
            Filtros
        </button>
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
            <div id="filters-accordion" class="collapse show mb-1" aria-labelledby="filters-heading" data-parent="#filters">
                <div class="col-12 p-0">
                    {{ Aire::open()->route('admin.user.search')->autoComplete('off') }}
                    <div class="form-row">
                        {{ Aire::input('name', 'Nome')->groupClass('col-md-4 col-lg-3') }}
                        {{ Aire::input('email', 'E-Mail')->groupClass('col-md-4 col-lg-3') }}
                        {{ Aire::select(['1' => 'Ativo', '0' => 'Inativo'], 'active', 'Situação')->groupClass('col-md-2') }}
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
        <div class="btn-toolbar mb-1" role="toolbar" aria-label="Ações Disponívels">
            <button class="btn btn-success ml-auto d-flex align-items-center">
                <i class="material material-add mr-1"></i> Novo Usuário
            </button>
        </div>

        <table class="table table-hover table-striped" id="main-list">
            <thead class="thead-dark">
            <tr>
                <th scope="col">
                    <span class="d-flex align-items-center text-bold text-white" data-sort="id">
                        ID <i class="ml-1 material material-arrow-downward"></i>
                    </span>
                </th>
                <th scope="col">
                    <span class="d-flex align-items-center text-bold text-white" data-sort="name">
                        Nome
                    </span>
                </th>
                <th scope="col">
                    <span class="d-flex align-items-center text-bold text-white" data-sort="email">
                        E-mail
                    </span>
                </th>
                <th scope="col">
                    <span class="d-flex align-items-center text-bold text-white" data-sort="last-login">
                        Último Acesso
                    </span>
                </th>
                <th scope="col" class="text-right">
                    <span class="text-bold text-white">
                        Ações
                    </span>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>Gabriel Cesar Mello</td>
                <td>95gabrielcesar@gmail.com</td>
                <td>04/09/2019 18:30</td>
                <td class="text-right">
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <button type="button" class="btn btn-info text-white d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="Visualizar">
                            <i class="material material-remove-red-eye"></i>
                        </button>
                        <button type="button" class="btn btn-primary text-white d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="Editar">
                            <i class="material material-create"></i>
                        </button>
                        <div class="btn-group" role="group">
                            <button id="row-ID-dropdown" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu" aria-labelledby="row-ID-dropdown">
                                <a class="dropdown-item" href="#">Ação 3</a>
                                <a class="dropdown-item" href="#">Ação 4</a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Lucas de Mello</td>
                <td>lucasmello@gmail.com</td>
                <td>04/09/2019 18:33</td>
                <td class="text-right">
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <button type="button" class="btn btn-info text-white d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="Visualizar">
                            <i class="material material-remove-red-eye"></i>
                        </button>
                        <button type="button" class="btn btn-primary text-white d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="Editar">
                            <i class="material material-create"></i>
                        </button>
                        <div class="btn-group" role="group">
                            <button id="row-ID-dropdown" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu" aria-labelledby="row-ID-dropdown">
                                <a class="dropdown-item" href="#">Ação 3</a>
                                <a class="dropdown-item" href="#">Ação 4</a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Gustavo de Mello</td>
                <td>gumello@gmail.com</td>
                <td>04/09/2019 18:38</td>
                <td class="text-right">
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <button type="button" class="btn btn-info text-white d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="Visualizar">
                            <i class="material material-remove-red-eye"></i>
                        </button>
                        <button type="button" class="btn btn-primary text-white d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="Editar">
                            <i class="material material-create"></i>
                        </button>
                        <div class="btn-group" role="group">
                            <button id="row-ID-dropdown" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu" aria-labelledby="row-ID-dropdown">
                                <a class="dropdown-item" href="#">Ação 3</a>
                                <a class="dropdown-item" href="#">Ação 4</a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </section>
@stop
