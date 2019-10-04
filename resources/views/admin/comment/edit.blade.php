@extends('admin.layouts.popup')

@section('title', 'Edição de Comentário')
@section('icon', 'comment-edit')

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
    {{ Aire::open()->id('comment_update')->route('admin.comment.update', $comment->id)->method('PUT')->bind($comment)->multipart()->autoComplete('off') }}
    @include('admin.comment.form')
    {{ Aire::close() }}
@stop

@section('footer')
    <div class="btn-toolbar w-100 justify-content-between" role="toolbar" aria-label="Ações Disponíveis">
        <button class="btn btn-light" data-dismiss="modal">
            <i class="mdi mdi-close-circle mr-1"></i> Cancelar
        </button>
        <button class="btn btn-primary" data-trigger-submit="comment_update">
            <i class="mdi mdi-content-save mr-1"></i> Salvar
        </button>
    </div>
@stop