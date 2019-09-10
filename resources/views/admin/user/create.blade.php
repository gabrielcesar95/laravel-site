@extends('admin.layouts.popup')

@section('title', 'Novo Usuário')

@section('header')
    <h5 class="modal-title text-bold" id="modal-label">@yield('title')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
@stop

@section('content')
    <p>teste</p>
@stop

@section('footer')
    <button type="button" class="btn btn-primary">Salvar</button>
@stop
