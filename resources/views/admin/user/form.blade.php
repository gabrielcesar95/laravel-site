<div id="alerts"></div>

<ul class="nav nav-tabs mb-2" id="tab-content" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="data-tab" data-toggle="tab" href="#data" role="tab" aria-controls="data" aria-selected="true">Dados</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="permissions-tab" data-toggle="tab" href="#permissions" role="tab" aria-controls="permissions" aria-selected="false">Permissões</a>
    </li>
</ul>
<div class="tab-content" id="tab-content">
    <div class="tab-pane fade show active" id="data" role="tabpanel" aria-labelledby="data-tab">
        <div class="form-row">
            {{ Aire::input('name', 'Nome')->groupClass('form-group col-md-5') }}
            {{ Aire::input('email', 'E-Mail')->groupClass('form-group col-md-5') }}
            {{ Aire::input('active', 'Situação')->type('checkbox')->groupClass('form-group col-md-2')->data('toggle', 'toggle')->data('style', 'w-100')->data('on', 'Ativo')->data('off', 'Inativo')->data('onstyle', 'success')->data('offstyle', 'danger')->value(1)->checked() }}
        </div>
        <div class="form-row">
            {{ Aire::password('password', 'Senha')->groupClass('form-group col-md-4')->value('') }}
            {{ Aire::password('password_confirmation', 'Confirme a Senha')->groupClass('form-group col-md-4')->value('') }}
        </div>
    </div>
    <div class="tab-pane fade" id="permissions" role="tabpanel" aria-labelledby="permissions-tab">
        <div class="form-row">
            <div class="col-md-6">
                <h4>Grupos de Acesso</h4>
                <div class="overflow-auto" style="max-height: 300px;" data-simplebar>
                    @if(count($roles))
                        @foreach($roles as $role)
                            {{ Aire::input('roles[]')->type('checkbox')->data('toggle', 'toggle')->data('style', 'mb-1 w-100')->data('on', $role->name)->data('off', $role->name)->data('onstyle', 'success')->data('offstyle', 'light')->value($role->id)->checked(isset($user) && $user->hasRole($role->id))->withoutGroup() }}
                        @endforeach
                    @else
                        Nenhum grupo encontrado
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <h4>Permissões Diretas</h4>
                <div class="overflow-auto" style="max-height: 300px;" data-simplebar>
                    @if(count($permissions))
                        @foreach($permissions as $key => $group)
                            <span class="py-0">{{ __("permissions.roles.{$key}.role") }}</span>
                            @foreach($group as $permission)
                                {{ Aire::input('permissions[]')->type('checkbox')->data('toggle', 'toggle')->data('style', 'mb-1 w-100')->data('on', __("permissions.roles.{$key}.permissions.{$permission->name}"))->data('off', __("permissions.roles.{$key}.permissions.{$permission->name}"))->data('onstyle', 'success')->data('offstyle', 'light')->value($permission->id)->checked(isset($user) && in_array($permission->id, $user->directPermissions))->withoutGroup() }}
                            @endforeach
                        @endforeach
                    @else
                        Nenhuma permissão encontrada
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
