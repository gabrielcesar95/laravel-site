@extends('admin.layouts.popup')

@section('title', 'Dados da Categoria')

@section('header')
    <h5 class="modal-title text-bold" id="modal-label">@yield('title')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
@stop

@section('content')
    <form action="" method="POST" id="category_show" autocomplete="off">

        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}" disabled>
        </div>

        @if(isset($category) && $category->cover)
            <span>Imagem de Capa</span>
            <img src="{{ url('storage/'.$category->cover) }}" alt="{{ $category->name }}" class="img-thumbnail mb-1">
        @endif

        <div class="form-group">
            <label for="slug">Link</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="slug" value="{{ url($category->slug) }}" id="slug" disabled>
                <div class="input-group-append">
                    <a class="input-group-text mdi mdi-open-in-new" href="{{ url($category->slug) }}" target="_blank" data-toggle="tooltip" data-placement="top" title="Acessar">
                    </a>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class=" cursor-pointer" for="description">Descrição</label>
            <textarea class="form-control" name="description" id="description" disabled>{{ $category->description }}</textarea>
        </div>
    </form>
@stop
