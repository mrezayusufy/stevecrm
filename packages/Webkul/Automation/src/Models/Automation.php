<?php

namespace Webkul\Automation\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;
use Webkul\Automation\Contracts\Automation as AutomationContract;
use Webkul\User\Models\UserProxy;
use Webkul\Lead\Models\LeadProxy;
use Webkul\Lead\Models\StageProxy;
use Webkul\Tag\Models\TagProxy;

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
        'days_after', // days
        'send_time', // time
        'include_tags_ids', // tags
        'exclude_tags_ids', // tags
        'recipient', // lead
        'sender', // user_id
        'lead_pipeline_stage_id', // lead
        'text_template_id', // done
        'is_done', //
        'status', //
    ];


    /**
     * The sender that belong to the activity.
     */
    public function sender()
    {
        return $this->belongsTo(UserProxy::modelClass(), 'sender');
    }


    /**
     * The text templates that belong to the activity.
     */
    public function textTemplate()
    {
        return $this->belongsTo(TextTemplateProxy::modelClass(), 'lead_pipeline_stage_id');
    }

    /**
     * The text templates that belong to the activity.
     */
    public function stage()
    {
        return $this->belongsTo(StageProxy::modelClass());
    }

    /**
     * The Automation that has many to the tags.
     */
    public function includeTags()
    {
        return $this->hasMany(TagProxy::class, 'include_tags_ids');
    }
    /**
     * The Automation that has many to the tags.
     */
    public function excludeTags()
    {
        return $this->hasMany(TagProxy::class, 'exclude_tags_ids');
    }


}
