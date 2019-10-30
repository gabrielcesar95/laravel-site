<?php

namespace App\Models;

use App\Support\Helpers;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Contact extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['requester', 'requester_phone', 'requester_email', 'subject', 'content'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;
    protected static $logName = 'Contact';

    protected $table = 'contact_requests';
    protected $fillable = ['requester', 'requester_phone', 'requester_email', 'subject', 'content'];

    public function setRequesterPhoneAttribute($value)
    {
        $this->attributes['requester_phone'] = Helpers::removeSpecials($value);
    }

    public function getRequesterPhoneAttribute($value)
    {
        return Helpers::formatPhone($value);
    }

    public function getCreatedAtAttribute($value)
    {
        return Helpers::format_date(new \DateTime($value), 'd/m/Y à\s H:i');
    }
}
