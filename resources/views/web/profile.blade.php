@extends('web.layouts.main')

@section('title', 'Meu Perfil - ' . env('APP_NAME'))

@section('content')
    @include('web.layouts.navbar')
    <div class="container">
        @if(!auth()->user()->hasVerifiedEmail())
            <div class="alert alert-warning mt-1" role="alert">
                Seu e-mail ainda não foi verificado
                <a href="{{ route('verification.resend') }}" class="alert-link">Clique aqui para reenviar o e-mail de verificação.</a>
            </div>
        @endif

        <div class="row my-2">
            <div class="col-lg-4 mb-2 mb-lg-0 d-flex justify-content-center d-lg-block text-lg-center">
                <img src="{{ auth()->user()->avatar ?? asset('web/assets/img/avatar.png') }}" class="img-fluid img-circle" alt="avatar">
            </div>

            <div class="col-lg-8">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="" data-target="#edit" data-toggle="tab" class="nav-link active">Editar perfil</a>
                    </li>
                </ul>
                <div class="tab-content pt-2 pb-3">
                    <div class="tab-pane active" id="edit">
                        {{ Aire::open()->id('profile_edit')->route('web.profile.update')->autoComplete('off') }}
                        @if($errors)
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissable fade show mb-1 py-1" role="alert">
                                    {{ $error }}
                                    <button class="close" type="button" data-dismiss="alert" aria-label="Fechar">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endforeach
                        @endif

                        <div class="form-row">
                            {{ Aire::input('name', 'Nome')->value(old('name', auth()->user()->name ?? ''))->groupClass('form-group col-md-6') }}
                            {{ Aire::input('email', 'E-Mail')->value(old('email', auth()->user()->email ?? ''))->groupClass('form-group col-md-6') }}
                        </div>

                        <div class="form-row">
                            {{ Aire::password('password', 'Alterar Senha')->groupClass('form-group col-md-6')->value('') }}
                            {{ Aire::password('password_confirmation', 'Confirme a Senha')->groupClass('form-group col-md-6')->value('') }}
                        </div>

                        <div class="btn-toolbar w-100" role="toolbar" aria-label="Ações Disponíveis">
                            <button type="submit" class="btn btn-primary ml-auto">
                                Salvar
                            </button>
                        </div>
                        {{ Aire::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('web.layouts.footer')
@endsection

@push('js')
    <script>

    </script>
@endpush

@push('css')
    <style>

    </style>
@endpush
