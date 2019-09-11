@extends('admin.layouts.popup')

@section('title', 'Novo Usuário')

@section('header')
    <h5 class="modal-title text-bold" id="modal-label">@yield('title')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
@stop

@section('content')
    {{ Aire::open()->id('user_create')->route('admin.user.store')->autoComplete('off') }}
    <div class="form-row">
        {{ Aire::input('name', 'Nome')->groupClass('form-group col-md-5') }}
        {{ Aire::input('email', 'E-Mail')->groupClass('form-group col-md-5') }}
        {{ Aire::input('active', 'Situação')->type('checkbox')->groupClass('form-group col-md-2')->data('toggle', 'toggle')->data('width', '100%')->data('on', 'Ativo')->data('off', 'Inativo')->data('onstyle', 'success')->data('offstyle', 'danger')->value(1)->checked() }}
    </div>
    <div class="form-row">
        {{ Aire::password('password', 'Senha')->groupClass('form-group col-md-4') }}
        {{ Aire::password('password_repeat', 'Confirme a Senha')->groupClass('form-group col-md-4') }}
    </div>
    {{ Aire::close() }}
@stop

@section('footer')
    <button class="btn btn-primary" data-trigger-submit="user_create">Salvar</button>
@stop
