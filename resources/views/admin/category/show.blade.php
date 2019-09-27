@extends('admin.layouts.popup')

@section('title', 'Dados do Grupo de Acesso')

@section('header')
    <h5 class="modal-title text-bold" id="modal-label">@yield('title')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
@stop

@section('content')
    {{ Aire::open()->id('user_create')->bind($category)->autoComplete('off') }}
    {{ Aire::input('name', 'Nome')->groupClass('form-group')->setAttribute('disabled', true) }}


    <div class="input-group mb-3">
        {{ Aire::input('slug', 'Link')->value(url($category->slug))->groupClass('form-group')->withoutGroup()->setAttribute('disabled', true) }}
        <div class="input-group-append">
            <a class="input-group-text mdi mdi-open-in-new" href="{{ url($category->slug) }}" target="_blank" data-toggle="tooltip" data-placement="top" title="Acessar">
            </a>
        </div>
    </div>

    {{ Aire::close() }}
@stop
