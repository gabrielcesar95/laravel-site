@extends('admin.layouts.popup')

@section('title', 'Dados do Grupo de Acesso')

@section('header')
    <h5 class="modal-title text-bold" id="modal-label">@yield('title')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
@stop

@section('content')
    {{ Aire::open()->id('role_show')->bind($role)->autoComplete('off') }}
    {{ Aire::input('name', 'Nome')->groupClass('form-group')->setAttribute('disabled', true) }}

    @if($permissions)
        <div class="overflow-auto" style="max-height: 300px;" data-simplebar>
            @foreach($permissions as $key => $group)
                <span class="py-0">{{ __("permissions.roles.{$key}.role") }}</span>
                @foreach($group as $permission)
                    {{ Aire::input('permissions[]')->type('checkbox')->data('toggle', 'toggle')->data('style', 'mb-1 w-100')->data('on', __("permissions.roles.{$key}.permissions.{$permission->name}"))->data('off', __("permissions.roles.{$key}.permissions.{$permission->name}"))->data('onstyle', 'dark')->data('offstyle', 'light')->value($permission->id)->checked(isset($role->permissions) && $role->permissions->contains($permission->id))->withoutGroup()->setAttribute('disabled', true) }}
                @endforeach
            @endforeach
        </div>
    @endif

    {{ Aire::close() }}
@stop
