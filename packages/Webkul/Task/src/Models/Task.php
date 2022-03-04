<?php

namespace Webkul\Task\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Attribute\Traits\CustomAttribute;
use Webkul\Task\Contracts\Task as TaskContract;

class Task extends Model implements TaskContract
{
    use CustomAttribute;

    protected $casts = [
        'subtask' => 'array',
        'assign_to' => 'array',
        'invite' => 'array',
    ];
    protected $fillable = [
        'title',
        'date',
        'time',
        'duration',
        'location',
        'assign_to',
        'link_to',
        'associate_with',
        'send_notification',
        'notification_from',
        'invite',
        'notes',
        'subtask',
    ];
}
