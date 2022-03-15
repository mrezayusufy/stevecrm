<?php

namespace Webkul\Automation\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;
use Webkul\Automation\Contracts\Automation as AutomationContract;
use Webkul\User\Models\UserProxy;
use Webkul\Lead\Models\LeadProxy;
class Automation extends Model implements AutomationContract
{
    protected $table = 'automations';


    protected $cast = [
        'include_tags_ids' => 'array',
        'exclude_tags_ids'  => 'array',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'days_after',
        'send_time',
        'include_tags_ids',
        'exclude_tags_ids',
        'recipient',
        'sender',
        'lead_pipeline_stage_id',
        'text_template_id',
    ];


    /**
     * The leads that belong to the activity.
     */
    public function leads()
    {
        return $this->belongsToMany(LeadProxy::modelClass(), 'lead_activities');
    }
}
