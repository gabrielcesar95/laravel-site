@extends('admin.layouts.popup')

@section('title', 'Novo Usuário')
@section('icon', 'account-plus')

@section('header')
    <h5 class="modal-title text-bold" id="modal-label">
        <i class="mr-1 mdi mdi-@yield('icon')"></i>
        @yield('title')
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
@stop

@section('content')
    <form action="{{ route('admin.user.store') }}" method="POST" id="user_create" enctype="multipart/form-data" autocomplete="off">
        @include('admin.user.form')
    </form>
@stop

@section('footer')
    <div class="btn-toolbar w-100 justify-content-between" role="toolbar" aria-label="Ações Disponíveis">
        <button class="btn btn-light" data-dismiss="modal">
            <i class="mdi mdi-close-circle mr-1"></i> Cancelar
        </button>
        <button class="btn btn-primary" data-trigger-submit="user_create">
            <i class="mdi mdi-content-save mr-1"></i> Salvar
        </button>
    </div>
@stop
