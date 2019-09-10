@extends('admin.layouts.popup')

@section('title', 'Novo Usuário')

@section('header')
    <h5 class="modal-title text-bold" id="modal-label">@yield('title')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
@stop

@section('content')
    {{ Aire::open()->route('admin.user.store')->autoComplete('off')->rules(['name' => 'required']) }}
    <div class="form-row">
        {{ Aire::input('name', 'Nome')->groupClass('col-md-5') }}
        {{ Aire::input('email', 'E-Mail')->groupClass('col-md-5') }}
        {{ Aire::checkboxGroup([1 => 'Ativo'], 'active', 'Situação')->groupClass('col-md-2')}}
    </div>
    <div class="form-row">
        {{ Aire::password('password', 'Senha')->groupClass('col-md-5') }}
        {{ Aire::password('password_repeat', 'Confirme a Senha')->groupClass('col-md-5') }}
    </div>
    {{ Aire::close() }}
@stop

@section('footer')
    <button type="button" class="btn btn-primary">Salvar</button>
@stop
