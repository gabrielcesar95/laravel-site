<div id="alerts"></div>
<div class="form-row">
    {{ Aire::input('name', 'Nome')->groupClass('form-group col-12') }}
</div>

<div class="form-row">
    <div class="form-group col-12">
        <label>Permissões</label>
        @if($permissions)
            <div class="overflow-auto" style="max-height: 300px;" data-simplebar>
                @foreach($permissions as $key => $group)
                    <span class="py-0">{{ __("permissions.roles.{$key}.role") }}</span>
                    @foreach($group as $permission)
                        {{ Aire::input('permissions[]')->type('checkbox')->data('toggle', 'toggle')->data('style', 'mb-1 w-100')->data('on', __("permissions.roles.{$key}.permissions.{$permission->name}"))->data('off', __("permissions.roles.{$key}.permissions.{$permission->name}"))->data('onstyle', 'success')->data('offstyle', 'light')->value($permission->id)->checked(isset($role->permissions) && $role->permissions->contains($permission->id))->withoutGroup() }}
                    @endforeach
                @endforeach
            </div>
        @endif
    </div>
</div>
