<div id="alerts"></div>
<div class="form-row">
    <div class="form-group col-12">
        <label class=" cursor-pointer" for="name">Nome</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name ?? '') }}">
    </div>
    <div class="form-group col-12">
        <label class=" cursor-pointer" for="description">Nome</label>
        <textarea class="form-control" name="description" id="description">{{ old('description', $category->description ?? '') }}</textarea>
    </div>

    <div class="form-group col-12">
        <label for="cover" id="cover-label">Imagem de Capa</label>

        @if(isset($category) && $category->cover)
            <img src="{{ url('storage/'.$category->cover) }}" alt="{{ $category->name }}" class="img-thumbnail mb-1">
        @endif

        <div class="input-group">
            <div class="custom-file">
                <input type="file" id="cover" name="cover" class="custom-file-input" aria-describedby="cover-label">
                <label class="custom-file-label" for="cover">Selecionar Arquivo</label>
            </div>
        </div>
    </div>
</div>
