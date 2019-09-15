<div id="alerts"></div>
<div class="form-row">
    {{ Aire::input('name', 'Nome')->groupClass('form-group col-12') }}
</div>

<div class="form-row">
    <div class="form-group col-12">
        <label>Permissões</label>
        <div class="overflow-auto" style="max-height: 300px;" data-simplebar>
            <span class="py-0">Usuários</span>
            {{ Aire::input('permissions[]')->type('checkbox')->data('toggle', 'toggle')->data('style', 'mb-1 w-100')->data('on', 'Permissão')->data('off', 'Permissão')->data('onstyle', 'success')->data('offstyle', 'light')->value(1)->checked()->withoutGroup() }}
            {{ Aire::input('permissions[]')->type('checkbox')->data('toggle', 'toggle')->data('style', 'mb-1 w-100')->data('on', 'Permissão')->data('off', 'Permissão')->data('onstyle', 'success')->data('offstyle', 'light')->value(1)->checked()->withoutGroup() }}
            {{ Aire::input('permissions[]')->type('checkbox')->data('toggle', 'toggle')->data('style', 'mb-1 w-100')->data('on', 'Permissão')->data('off', 'Permissão')->data('onstyle', 'success')->data('offstyle', 'light')->value(1)->checked()->withoutGroup() }}
            {{ Aire::input('permissions[]')->type('checkbox')->data('toggle', 'toggle')->data('style', 'mb-1 w-100')->data('on', 'Permissão')->data('off', 'Permissão')->data('onstyle', 'success')->data('offstyle', 'light')->value(1)->checked()->withoutGroup() }}

            <span class="py-0">Grupos</span>
            {{ Aire::input('permissions[]')->type('checkbox')->data('toggle', 'toggle')->data('style', 'mb-1 w-100')->data('on', 'Permissão')->data('off', 'Permissão')->data('onstyle', 'success')->data('offstyle', 'light')->value(1)->checked()->withoutGroup() }}
            {{ Aire::input('permissions[]')->type('checkbox')->data('toggle', 'toggle')->data('style', 'mb-1 w-100')->data('on', 'Permissão')->data('off', 'Permissão')->data('onstyle', 'success')->data('offstyle', 'light')->value(1)->checked()->withoutGroup() }}
            {{ Aire::input('permissions[]')->type('checkbox')->data('toggle', 'toggle')->data('style', 'mb-1 w-100')->data('on', 'Permissão')->data('off', 'Permissão')->data('onstyle', 'success')->data('offstyle', 'light')->value(1)->checked()->withoutGroup() }}
            {{ Aire::input('permissions[]')->type('checkbox')->data('toggle', 'toggle')->data('style', 'mb-1 w-100')->data('on', 'Permissão')->data('off', 'Permissão')->data('onstyle', 'success')->data('offstyle', 'light')->value(1)->checked()->withoutGroup() }}

            <span class="py-0">Exemplo</span>
            {{ Aire::input('permissions[]')->type('checkbox')->data('toggle', 'toggle')->data('style', 'mb-1 w-100')->data('on', 'Permissão')->data('off', 'Permissão')->data('onstyle', 'success')->data('offstyle', 'light')->value(1)->checked()->withoutGroup() }}
            {{ Aire::input('permissions[]')->type('checkbox')->data('toggle', 'toggle')->data('style', 'mb-1 w-100')->data('on', 'Permissão')->data('off', 'Permissão')->data('onstyle', 'success')->data('offstyle', 'light')->value(1)->checked()->withoutGroup() }}
            {{ Aire::input('permissions[]')->type('checkbox')->data('toggle', 'toggle')->data('style', 'mb-1 w-100')->data('on', 'Permissão')->data('off', 'Permissão')->data('onstyle', 'success')->data('offstyle', 'light')->value(1)->checked()->withoutGroup() }}
            {{ Aire::input('permissions[]')->type('checkbox')->data('toggle', 'toggle')->data('style', 'mb-1 w-100')->data('on', 'Permissão')->data('off', 'Permissão')->data('onstyle', 'success')->data('offstyle', 'light')->value(1)->checked()->withoutGroup() }}
        </div>
    </div>
</div>
