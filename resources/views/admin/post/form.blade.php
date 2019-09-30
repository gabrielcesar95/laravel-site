<div id="alerts"></div>
<div class="form-row">
    {{ Aire::input('name', 'Nome')->id('name')->groupClass('form-group col-12') }}
    {{ Aire::textArea('description', 'Descrição')->id('description')->groupClass('form-group col-12') }}

    <div class="form-group col-12">
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
</div>

<script>
	$(function () {

		CKEDITOR.replace('description');
	});
</script>
