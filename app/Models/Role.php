<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
    use LogsActivity;

    protected static $logAttributes = ['name', 'permissions'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;
    protected static $logName = 'Role';
}
