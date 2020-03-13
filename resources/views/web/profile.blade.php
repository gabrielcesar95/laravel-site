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
                        <form action="{{ route('web.profile.update') }}" method="POST" id="profile_edit" autocomplete="off">
                            @csrf
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
                                <div class="form-group col-md-6">
                                    <label for="name">Nome</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', auth()->user()->name ?? '') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">E-Mail</label>
                                    <input type="text" name="email" id="email" class="form-control" value="{{ old('email', auth()->user()->email ?? '') }}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class=" cursor-pointer" for="password">Alterar Senha</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class=" cursor-pointer" for="password_confirmation">Alterar Senha</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                </div>
                            </div>

                            <div class="btn-toolbar w-100" role="toolbar" aria-label="Ações Disponíveis">
                                <button type="submit" class="btn btn-primary ml-auto">
                                    Salvar
                                </button>
                            </div>
                        </form>
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
