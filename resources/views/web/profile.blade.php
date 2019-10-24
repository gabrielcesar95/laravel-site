@extends('web.layouts.main')

@section('title', env('APP_NAME') . ' - Meu Perfil')

@section('content')
    @include('web.layouts.navbar')
    <div class="container">
        <div class="row my-2">
            <div class="col-lg-4 text-sm-center mb-2 mb-lg-0">
                <img src="{{ auth()->user()->avatar ?? '//placehold.it/150' }}" class="mx-auto img-fluid img-circle" alt="avatar">
            </div>

            <div class="col-lg-8">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="" data-target="#edit" data-toggle="tab" class="nav-link active">Editar perfil</a>
                    </li>
                </ul>
                <div class="tab-content pb-3">
                    <div class="tab-pane active" id="edit">
                        <h4 class="my-2">Editar perfil</h4>
                        <form role="form">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Nome</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" value="Jane">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">E-mail</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="email" value="email@gmail.com">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Senha</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="password" value="11111122333">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Confirmar Senha</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="password" value="11111122333">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="reset" class="btn btn-secondary" value="Cancel">
                                    <input type="button" class="btn btn-primary" value="Save Changes">
                                </div>
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
