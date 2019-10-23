@extends('admin.layouts.popup')

@section('title', 'Dados da Postagem')

@section('header')
    <h5 class="modal-title text-bold" id="modal-label">@yield('title')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
@stop

@section('content')
    {{ Aire::open()->id('post_show')->bind($contact)->autoComplete('off') }}
    <div class="form-row">
        {{ Aire::input('requester', 'Requisitante')->id('requester')->groupClass('form-group col-12')->setAttribute('disabled', true) }}
        {{ Aire::input('requester_email', 'E-mail')->id('requester_email')->groupClass('form-group col-12')->setAttribute('disabled', true) }}
        {{ Aire::input('requester_phone', 'Telefone')->id('requester_phone')->groupClass('form-group col-12')->setAttribute('disabled', true) }}
        {{ Aire::input('subject', 'Assunto')->id('subject')->groupClass('form-group col-12')->setAttribute('disabled', true) }}
        {{ Aire::textArea('content', 'Mensagem')->id('content')->groupClass('form-group col-12')->setAttribute('disabled', true) }}
    </div>
    {{ Aire::close() }}
@stop
