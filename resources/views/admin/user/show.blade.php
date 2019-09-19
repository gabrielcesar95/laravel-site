@extends('admin.layouts.popup')

@section('title', 'Dados do Usuário')

@section('header')
    <h5 class="modal-title text-bold" id="modal-label">@yield('title')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
@stop

@section('content')
    {{ Aire::open()->id('user_create')->bind($user)->autoComplete('off') }}
    {{ Aire::input('name', 'Nome')->groupClass('form-group')->setAttribute('disabled', true) }}
    {{ Aire::input('email', 'E-Mail')->groupClass('form-group')->setAttribute('disabled', true) }}
    {{ Aire::input('active', 'Situação')->type('checkbox')->groupClass('form-group')->data('toggle', 'toggle')->data('width', '100%')->data('on', 'Ativo')->data('off', 'Inativo')->data('onstyle', 'dark')->data('offstyle', 'danger')->value(1)->checked($user->active)->setAttribute('disabled', true) }}
    {{ Aire::close() }}
@stop
