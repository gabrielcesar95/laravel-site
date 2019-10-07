@extends('admin.layouts.popup')

@section('title', 'Dados do Comentário')

@section('header')
    <h5 class="modal-title text-bold" id="modal-label">@yield('title')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
@stop

@section('content')
    {{ Aire::open()->id('comment_show')->route('admin.comment.update', [$comment->id])->bind($comment)->autoComplete('off') }}
    <div class="form-row">
        <div class="col-12">
            <label>Conteúdo</label>
            <div class="form-group post-show-content" data-simplebar>
                {!! $comment->content !!}
            </div>
        </div>
    </div>

    <div class="form-row">
        {{ Aire::input('commentable_type', 'Tipo')->id('name')->groupClass('form-group col-6')->value($comment->commentable_type)->setAttribute('disabled', true) }}
        {{ Aire::input('commentable_slug', 'Local')->value($comment->commentable->name)->groupClass('form-group col-6')->setAttribute('disabled', true) }}
        {{ Aire::input('user', 'Autor')->value($comment->user->name)->groupClass('form-group col-12')->setAttribute('disabled', true) }}
        {{ Aire::hidden('action')->id('action') }}
    </div>
    {{ Aire::close() }}
@stop

@section('footer')
    <div class="btn-toolbar w-100 justify-content-between" role="toolbar" aria-label="Ações Disponíveis">
        <button class="btn btn-light mr-auto" data-dismiss="modal">
            <i class="mdi mdi-close-circle mr-1"></i> Cancelar
        </button>

        @if(auth()->user()->can('comment@delete'))
            <button class="btn btn-danger mr-1" id="btn_delete" data-trigger-popup="{{ route('admin.comment.delete', $comment->id) }}">
                <i class="mdi mdi-trash-can mr-1"></i> Excluir
            </button>
        @endif
        @if(!$comment->approved)
            <button class="btn btn-success" id="btn_approve" data-trigger-submit="comment_show">
                <i class="mdi mdi-check-circle-outline mr-1"></i> Aprovar
            </button>
        @endif
    </div>
@stop

<script>
	$(function () {
		$('#btn_delete').on('click', function (event) {
			event.preventDefault();
		});
		$('#btn_approve').on('click', function () {
			$('#action').val('approve');
		});
	});
</script>
