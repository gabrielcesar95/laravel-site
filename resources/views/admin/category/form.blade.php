<div id="alerts"></div>
<div class="form-row">
    {{ Aire::input('name', 'Nome')->groupClass('form-group col-12') }}
    {{ Aire::textArea('description', 'Descrição')->groupClass('form-group col-12') }}

    <div class="form-group col-12">
        <label for="cover" id="cover-label">Imagem de Capa</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" id="cover" name="cover" class="custom-file-input" aria-describedby="cover-label">
                <label class="custom-file-label" for="cover">Selecionar Arquivo</label>
            </div>
        </div>
    </div>
</div>
