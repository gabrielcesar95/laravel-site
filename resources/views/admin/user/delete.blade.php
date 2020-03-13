@extends('admin.layouts.popup')

@section('title', 'Deletar Usuário')

@section('header')
    <h5 class="modal-title text-bold text-danger" id="modal-label">@yield('title')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
@stop

@section('content')
    <div id="alerts"></div>

    <p>
        Confirma a exclusão do usuário
        <span class="text-bold">{{ $user->name }}</span>
        ?
    </p>
    <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" id="user_delete">
        @method('DELETE')
    </form>
@stop

@section('footer')
    <div class="btn-toolbar w-100 justify-content-between" role="toolbar" aria-label="Ações Disponíveis">
        <button class="btn btn-light" data-dismiss="modal">Cancelar</button>
        <button class="btn btn-danger" data-trigger-submit="user_delete">Confirmar</button>
    </div>
@stop
