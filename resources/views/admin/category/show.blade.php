@extends('admin.layouts.popup')

@section('title', 'Dados da Categoria')

@section('header')
    <h5 class="modal-title text-bold" id="modal-label">@yield('title')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
@stop

@section('content')
    {{ Aire::open()->id('category_show')->bind($category)->autoComplete('off') }}
    {{ Aire::input('name', 'Nome')->groupClass('form-group')->setAttribute('disabled', true) }}

    @if(isset($category) && $category->cover)
        <span>Imagem de Capa</span>
        <img src="{{ url('storage/'.$category->cover) }}" alt="{{ $category->name }}" class="img-thumbnail mb-1">
    @endif

    <div class="form-group">
        <label for="slug">Link</label>
        <div class="input-group mb-3">
            {{ Aire::input('slug', 'Link')->value(url($category->slug))->groupClass('form-group')->withoutGroup()->setAttribute('disabled', true) }}
            <div class="input-group-append">
                <a class="input-group-text mdi mdi-open-in-new" href="{{ url($category->slug) }}" target="_blank" data-toggle="tooltip" data-placement="top" title="Acessar">
                </a>
            </div>
        </div>
    </div>

    {{ Aire::textArea('description', 'Descrição')->groupClass('form-group')->setAttribute('disabled', true) }}

    {{ Aire::close() }}
@stop
