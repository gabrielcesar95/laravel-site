@extends('admin.layouts.popup')

@section('title', 'Dados do Usuário')

@section('header')
    <h5 class="modal-title text-bold" id="modal-label">@yield('title')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
@stop

@section('content')
    <ul class="nav nav-tabs mb-2" id="tab-content" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="data-tab" data-toggle="tab" href="#data" role="tab" aria-controls="data" aria-selected="true">Dados</a>
        </li>
        @if(count($roles) || count($user->directPermissions))
            <li class="nav-item">
                <a class="nav-link" id="permissions-tab" data-toggle="tab" href="#permissions" role="tab" aria-controls="permissions" aria-selected="false">Permissões</a>
            </li>
        @endif
    </ul>
    {{ Aire::open()->id('user_create')->bind($user)->autoComplete('off') }}
    <div class="tab-content" id="tab-content">
        <div class="tab-pane fade show active" id="data" role="tabpanel" aria-labelledby="data-tab">
            {{ Aire::input('name', 'Nome')->groupClass('form-group')->setAttribute('disabled', true) }}
            {{ Aire::input('email', 'E-Mail')->groupClass('form-group')->setAttribute('disabled', true) }}
            {{ Aire::input('active', 'Situação')->type('checkbox')->groupClass('form-group')->data('toggle', 'toggle')->data('width', '100%')->data('on', 'Ativo')->data('off', 'Inativo')->data('onstyle', 'dark')->data('offstyle', 'danger')->value(1)->checked($user->active)->setAttribute('disabled', true) }}
        </div>
        <div class="tab-pane fade" id="permissions" role="tabpanel" aria-labelledby="permissions-tab">
            @if(count($roles))
                <div class="form-row">
                    <h4>Grupos de Acesso</h4>
                    <div class="w-100 overflow-auto" style="max-height: 300px;" data-simplebar>
                        <label>Grupos de Acesso</label>
                        @foreach($roles as $role)
                            {{ Aire::input('roles[]', '')->type('checkbox')->groupClass('form-group')->data('toggle', 'toggle')->data('width', '100%')->data('on', $role->name)->data('off', $role->name)->data('onstyle', 'dark')->data('offstyle', 'light')->value(1)->checked()->setAttribute('disabled', true) }}
                        @endforeach
                    </div>
                </div>
            @endif
            @if(count($user->directPermissions))
                <div class="form-row">
                    <h4>Permissões Diretas</h4>
                    <div class="w-100 overflow-auto" style="max-height: 300px;" data-simplebar>
                        @foreach($permissions as $key => $group)
                            <span class="py-0">{{ __("permissions.roles.{$key}.role") }}</span>
                            @foreach($group as $permission)
                                {{ Aire::input('permissions[]')->type('checkbox')->data('toggle', 'toggle')->data('style', 'mb-1 w-100')->data('on', __("permissions.roles.{$key}.permissions.{$permission->name}"))->data('off', __("permissions.roles.{$key}.permissions.{$permission->name}"))->data('onstyle', 'dark')->data('offstyle', 'light')->value($permission->id)->checked(isset($user) && in_array($permission->id, $user->directPermissions))->setAttribute('disabled', true)->withoutGroup() }}
                            @endforeach
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    {{ Aire::close() }}
@stop
