<div id="alerts"></div>
<div class="form-row">
    {{ Aire::input('name', 'Nome')->groupClass('form-group col-md-5') }}
    {{ Aire::input('email', 'E-Mail')->groupClass('form-group col-md-5') }}
    {{ Aire::input('active', 'Situação')->type('checkbox')->groupClass('form-group col-md-2')->data('toggle', 'toggle')->data('style', 'w-100')->data('on', 'Ativo')->data('off', 'Inativo')->data('onstyle', 'success')->data('offstyle', 'danger')->value(1)->checked() }}
</div>
<div class="form-row">
    {{ Aire::password('password', 'Senha')->groupClass('form-group col-md-4')->value('') }}
    {{ Aire::password('password_confirmation', 'Confirme a Senha')->groupClass('form-group col-md-4')->value('') }}
</div>
