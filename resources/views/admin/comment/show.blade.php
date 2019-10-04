@extends('admin.layouts.popup')

@section('title', 'Dados do Comentário')

@section('header')
    <h5 class="modal-title text-bold" id="modal-label">@yield('title')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
@stop

@section('content')
    {{ Aire::open()->id('comment_show')->bind($comment)->autoComplete('off') }}
    <div class="form-row">
        {{ Aire::input('name', 'Nome')->id('name')->groupClass('form-group col-12')->setAttribute('disabled', true) }}
        {{ Aire::input('subtitle', 'Subtítulo')->id('subtitle')->groupClass('form-group col-12')->setAttribute('disabled', true) }}
        <div class="form-group col-12">
            <label for="slug">Link</label>
            <div class="input-group mb-3">
                {{ Aire::input('slug', 'Link')->value(route('web.comment.show', [$comment->slug]))->groupClass('form-group')->withoutGroup()->setAttribute('disabled', true) }}
                <div class="input-group-append">
                    <a class="input-group-text mdi mdi-open-in-new" href="{{ route('web.comment.show', [$comment->slug]) }}" target="_blank" data-toggle="tooltip" data-placement="top" title="Acessar">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col-12">
            <label>Conteúdo</label>
            <div class="form-group post-show-content" data-simplebar>
                {!! $comment->content !!}
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-lg-6">
            <label for="cover" id="cover-label">Imagem de Capa</label>
            @if(isset($comment) && $comment->cover)
                <img src="{{ url('storage/'.$comment->cover) }}" alt="{{ $comment->name }}" class="img-thumbnail mb-1">
            @endif
        </div>

        {{ Aire::input('active', 'Situação')->type('checkbox')->groupClass('form-group col-lg-3')->data('toggle', 'toggle')->data('width', '100%')->data('on', 'Publicada')->data('off', 'Oculta')->data('onstyle', 'success')->data('offstyle', 'danger')->value(1)->checked($comment->approved)->setAttribute('disabled', true) }}

    </div>
    {{ Aire::close() }}
@stop
