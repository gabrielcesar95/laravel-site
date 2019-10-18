@extends('admin.layouts.popup')

@section('title', 'Dados da Postagem')

@section('header')
    <h5 class="modal-title text-bold" id="modal-label">@yield('title')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
@stop

@section('content')
    {{ Aire::open()->id('post_show')->bind($post)->autoComplete('off') }}
    <div class="form-row">
        {{ Aire::input('name', 'Nome')->id('name')->groupClass('form-group col-12')->setAttribute('disabled', true) }}
        {{ Aire::input('subtitle', 'Subtítulo')->id('subtitle')->groupClass('form-group col-12')->setAttribute('disabled', true) }}

        <div class="form-group col-12">
            <label for="categories">Categorias</label>
            <select name="categories[]" id="categories" class="select2" multiple disabled>
                @forelse(\App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}" @if(isset($post) && $post->categories->pluck('id')->contains($category->id)) {{ 'selected' }} @endif>{{ $category->name }}</option>
                @empty
                    <option value="" disabled>Nenhuma categoria encontrada</option>
                @endforelse
            </select>
        </div>

        <div class="form-group col-12">
            <label for="slug">Link</label>
            <div class="input-group mb-3">
                {{ Aire::input('slug', 'Link')->value(route('web.post.show', [$post->slug]))->groupClass('form-group')->withoutGroup()->setAttribute('disabled', true) }}
                <div class="input-group-append">
                    <a class="input-group-text mdi mdi-open-in-new" href="{{ route('web.post.show', [$post->slug]) }}" target="_blank" data-toggle="tooltip" data-placement="top" title="Acessar">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col-12">
            <label>Conteúdo</label>
            <div class="form-group post-show-content" data-simplebar>
                {!! $post->content !!}
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-lg-6">
            <label for="cover" id="cover-label">Imagem de Capa</label>
            @if(isset($post) && $post->cover)
                <img src="{{ url('storage/'.$post->cover) }}" alt="{{ $post->name }}" class="img-thumbnail mb-1">
            @endif
        </div>

        {{ Aire::input('active', 'Situação')->type('checkbox')->groupClass('form-group col-lg-3')->data('toggle', 'toggle')->data('width', '100%')->data('on', 'Publicada')->data('off', 'Oculta')->data('onstyle', 'success')->data('offstyle', 'danger')->value(1)->checked($post->posted_at)->setAttribute('disabled', true) }}
        {{-- {{ Aire::input('posted_at', 'Data de Postagem')->id('posted_at')->groupClass('form-group col-lg-6')->class('mask-datetime')->setAttribute('disabled', true) }} --}}

    </div>
    {{ Aire::close() }}
@stop
