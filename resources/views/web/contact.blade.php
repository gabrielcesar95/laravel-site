@extends('web.layouts.main')

@section('title', env('APP_NAME') . ' - Contato')

@section('content')
    @include('web.layouts.navbar')
    <div class="container">
        <section class="row">
            <h1 class="mt-4">
                Entrar em contato
            </h1>
            <div class="w-100">
                <form class="pb-2" role="form" method="post" action="{{ route('web.contact.store') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-lg-4">
                            <label class="form-control-label" for="requester">Nome</label>
                            <input type="text" name="requester" id="requester" class="form-control @error('requester') is-invalid @enderror" value="{{ old('requester') }}" maxlength="256">
                            @error('requester')
                            <div class="alert alert-danger mb-0 mt-1 py-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-lg-4">
                            <label class="form-control-label" for="requester_email">Email</label>
                            <input type="email" name="requester_email" id="requester_email" class="form-control @error('requester_email') is-invalid @enderror" value="{{ old('requester_email') }}" maxlength="256">
                            @error('requester_email')
                            <div class="alert alert-danger mb-0 mt-1 py-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-lg-4">
                            <label class="form-control-label" for="requester_phone">Telefone</label>
                            <input type="tel" name="requester_phone" id="requester_phone" class="form-control @error('requester_phone') is-invalid @enderror" value="{{ old('requester_phone') }}" maxlength="15">
                            @error('requester_phone')
                            <div class="alert alert-danger mb-0 mt-1 py-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label class="form-control-label" for="subject">Assunto</label>
                            <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}" maxlength="128">
                            @error('subject')
                            <div class="alert alert-danger mb-0 mt-1 py-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-lg-12">
                            <label class="form-control-label" for="content">Mensagem</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" name="content"  id="content" rows="6" maxlength="1024">{{ old('content') }}</textarea>
                            @error('content')
                            <div class="alert alert-danger mb-0 mt-1 py-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="btn-toolbar col-12 justify-content-end" role="toolbar">
                            <button type="submit" class="btn btn-outline-primary">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
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
