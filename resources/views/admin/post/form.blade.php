<div id="alerts"></div>
<div class="form-row">
    {{ Aire::input('name', 'Nome')->id('name')->groupClass('form-group col-12') }}
    {{ Aire::input('subtitle', 'Subtítulo')->id('subtitle')->groupClass('form-group col-12') }}

    <div class="form-group col-12">
        <label for="categories">Categorias</label>
        <select name="categories[]" id="categories" class="select2" multiple>
            @forelse(\App\Models\Category::all() as $category)
                <option value="{{ $category->id }}" @if(isset($post) && $post->categories->pluck('id')->contains($category->id)) {{ 'selected' }} @endif>{{ $category->name }}</option>
            @empty
                <option value="" disabled>Nenhuma categoria encontrada</option>
            @endforelse
        </select>
    </div>

    {{ Aire::textArea('content', 'Conteúdo')->id('content')->groupClass('form-group col-12') }}

    <div class="form-group col-lg-6">
        <label for="cover" id="cover-label">Imagem de Capa</label>

        @if(isset($post) && $post->cover)
            <img src="{{ url('storage/'.$post->cover) }}" alt="{{ $post->name }}" class="img-thumbnail mb-1">
        @endif

        <div class="input-group">
            <div class="custom-file">
                <input type="file" id="cover" name="cover" class="custom-file-input" aria-describedby="cover-label">
                <label class="custom-file-label" for="cover">Selecionar Arquivo</label>
            </div>
        </div>
    </div>

    {{ Aire::input('posted', 'Situação')->type('checkbox')->groupClass('form-group col-lg-3')->data('toggle', 'toggle')->data('style', 'w-100')->data('on', 'Publicada')->data('off', 'Oculta')->data('onstyle', 'success')->data('offstyle', 'danger')->value(1)->checked(isset($post) && $post->posted_at) }}
    {{-- {{ Aire::input('posted_at', 'Data de Publicação')->id('posted_at')->groupClass('form-group col-lg-3')->class('mask-datetime') }} --}}

</div>

<script>
	$(function () {
		CKEDITOR.replace('content');

		CKEDITOR.instances.content.on('change', function () {
			$('#content').val(this.getData());
		});
	});
</script>
