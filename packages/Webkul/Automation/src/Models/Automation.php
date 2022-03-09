<?php

namespace Webkul\Automation\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Automation\Contracts\Automation as AutomationContract;
use Webkul\User\Models\UserProxy;
use Webkul\Lead\Models\LeadProxy;
class Automation extends Model implements AutomationContract
{
    protected $table = 'automations';


    protected $dates = [
        'schedule_from',
        'schedule_to',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'type',
        'location',
        'comment',
        'additional',
        'schedule_from',
        'schedule_to',
        'is_done',
        'at_period',
    ];


    /**
     * The leads that belong to the activity.
     */
    public function leads()
    {
        return $this->belongsToMany(LeadProxy::modelClass(), 'lead_activities');
    }
}