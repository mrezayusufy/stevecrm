<?php

namespace Webkul\Conversation\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Conversation\Contracts\Conversation as ConversationContract;

class Conversation extends Model implements ConversationContract
{
    protected $cast = [
        'attributes' => 'array',
    ];
    protected $fillable = [
        'sid',
        'chat_service_sid',
        'messaging_service_sid',
        'account_sid',
        'attributes',
        'friendly_name',
        'unique_name',
        'state',
    ];
}
