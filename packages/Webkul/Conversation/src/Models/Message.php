<?php

namespace Webkul\Conversation\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Conversation\Contracts\Message as MessageContract;

class Message extends Model implements MessageContract
{
    protected $fillable = [
        'sid',
        'account_sid',
        'conversation_id',
        'coneversation_sid',
        'body',
        'media',
        'author',
        'participant_sid',
        'delivery',
    ];
}
