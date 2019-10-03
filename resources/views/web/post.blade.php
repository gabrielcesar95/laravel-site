@extends('web.layouts.main')

@section('title', "{$post->name} - " . env('APP_NAME'))

@section('content')
    <section class="container bg-primary text-white py-4">
        <h1 class="text-center">{{ $post->name }}</h1>

    </section>
    <section class="container border py-5">
        <div>
            {!! $post->content !!}
        </div>
    </section>
    <section class="container py-5">
        <h1>Comentários</h1>

        <article>
            <h1>
                <a href="{{ route('login') }}">Faça login</a>
                para participar da discussão
            </h1>


        </article>

        <article>
            <h1>Participar da Discussão</h1>
            <form action="">
                <div class="form-row">
                    <div class="form-group col-2">
                        Foto
                    </div>
                    <div class="form-group col-7">
                        <textarea class="form-control" placeholder="Comentário"></textarea>
                    </div>
                    <div class="form-group col-3 d-flex justify-content-center align-items-center">
                        <button class="btn btn-outline-primary col-12">Enviar</button>
                    </div>
                </div>
            </form>
        </article>

        <article>
            <h1>Gabriel Cesar</h1>
            <p>
                Achei essa postagem muito interessante!
            </p>
        </article>
    </section>
@endsection

@push('js')
    <script>

    </script>
@endpush

@push('css')
    <style>

    </style>
@endpush
