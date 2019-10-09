@extends('admin.layouts.popup')

@section('title', 'Dados da Atividade')

@section('header_class', 'd-flex')
@section('header')
    <h5 class="modal-title text-bold" id="modal-label">@yield('title')</h5>

    <span class="badge badge-pill badge-{{ $log->badge['class'] }} ml-auto px-3 py-2">
        <i class="mdi mdi-{{ $log->badge['icon'] }}"></i>
        {{ $log->badge['description'] }}
    </span>

    <button type="button" class="ml-2 close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
@stop

@section('content')
    {{ Aire::open()->id('log_show')->bind($log)->autoComplete('off') }}
    <div class="form-row">
        <div class="col-12 col-lg-6">
            {{ Aire::input('causer', 'Responsável')->value($log->causer ? $log->causer->name : '[Responsável não atribuído]')->groupClass('form-group')->setAttribute('disabled', true) }}
        </div>
        <div class="col-6 col-lg-3">
            {{ Aire::input('log_name', 'Módulo')->value(__("logs.log_names.{$log->log_name}"))->groupClass('form-group')->setAttribute('disabled', true) }}
        </div>
        <div class="col-6 col-lg-3">
            {{ Aire::input('created_at', 'Data/Hora')->value(date_format($log->created_at, 'd/m/Y H:i:s'))->groupClass('form-group')->setAttribute('disabled', true) }}
        </div>

    </div>
    {{ Aire::close() }}
@stop
