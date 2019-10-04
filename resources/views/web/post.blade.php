@extends('web.layouts.main')

@section('title', "{$post->name} - " . env('APP_NAME'))

@section('content')
    <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Post Content Column -->
            <article class="col-12">

                <!-- Title -->
                <h1 class="mt-4">{{ $post->name }}</h1>

                <!-- Author -->
                <p class="lead">
                    por
                    {{ $post->user->name }}
                </p>

                <!-- Date/Time -->
                <p>Publicado em {{ $post->posted_at }}</p>

                <hr>

                <!-- Cover -->
                @if($post->cover)
                    <img class="img-fluid rounded" src="{{ url("storage/{$post->cover}") }}" alt="{{ $post->title }}" />

                    <hr>
                @endif

                <div>
                    {!! $post->content !!}
                </div>

                <hr>
                <div class="row">
                    @if($post->categories)
                        <article class="col-12 col-md-8">
                            <h5>Categorias</h5>
                            <ul class="nav nav-pills">
                                @foreach($post->categories as $category)
                                    <li class="nav-item">
                                        <a class="nav-link p-1" href="{{ url($category->slug) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </article>
                    @endif
                    <article class="col-12 col-md-4">
                        <h5>Visualizações</h5>
                        <p>{{ $post->views }}</p>
                    </article>
                </div>

                <!-- Comments Form -->
                <div class="card my-4">
                    <h5 class="card-header">Participe da Discussão:</h5>
                    <div class="card-body">
                        @if(auth()->guest())
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('login') }}" title="Fazer Login">Faça login</a>&nbsp;para comentar
                            </div>
                        @else
                            <form id="create_comment" method="post" action="{{ route('web.post.comment', $post->slug) }}" data-ajax>
                                <div class="alerts"></div>
                                <div class="form-group">
                                    <textarea name="content" class="form-control" rows="2" maxlength="640"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </form>
                        @endif
                    </div>
                </div>

                <!-- Single Comment -->
                <div class="media mb-4">
                    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                    <div class="media-body">
                        <h5 class="mt-0">Commenter Name</h5>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>

                <!-- Comment with nested comments -->
                <div class="media mb-4">
                    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                    <div class="media-body">
                        <h5 class="mt-0">Commenter Name</h5>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

                        <div class="media mt-4">
                            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                            <div class="media-body">
                                <h5 class="mt-0">Commenter Name</h5>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>

                        <div class="media mt-4">
                            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                            <div class="media-body">
                                <h5 class="mt-0">Commenter Name</h5>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>

                    </div>
                </div>
            </article>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
        </div>
        <!-- /.container -->
    </footer>

    @endsection

    @push('js')
        <script>

        </script>
    @endpush

    @push('css')
        <style>

        </style>
    @endpush
