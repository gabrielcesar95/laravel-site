@extends('admin.layouts.popup')

@section('title', 'Meu Perfil')
@section('icon', 'account-edit')

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
    {{ Aire::open()->id('profile_edit')->route('admin.profile.update')->bind(auth()->user())->autoComplete('off') }}
    <div id="alerts"></div>

    <div class="form-row">
        {{ Aire::input('name', 'Nome')->groupClass('form-group col-md-6') }}
        {{ Aire::input('email', 'E-Mail')->groupClass('form-group col-md-6') }}
    </div>
    <div class="form-row">
        {{ Aire::password('password', 'Alterar Senha')->groupClass('form-group col-md-6')->value('') }}
        {{ Aire::password('password_confirmation', 'Confirme a Senha')->groupClass('form-group col-md-6')->value('') }}
    </div>

    {{ Aire::close() }}
@stop

@section('footer')
    <div class="btn-toolbar w-100 justify-content-between" role="toolbar" aria-label="Ações Disponíveis">
        <button class="btn btn-light" data-dismiss="modal">
            <i class="mdi mdi-close-circle mr-1"></i> Cancelar
        </button>
        <button class="btn btn-primary" data-trigger-submit="profile_edit">
            <i class="mdi mdi-content-save mr-1"></i> Salvar
        </button>
    </div>
@stop
