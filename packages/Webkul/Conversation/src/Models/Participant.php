<?php

namespace Webkul\Conversation\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Conversation\Contracts\Participant as ParticipantContract;

class Participant extends Model implements ParticipantContract
{
    protected $cast = [
        'attributes' => 'array',
        'messaging_binding' => 'array',
    ];
    protected $fillable = [
        'sid',
        'account_sid',
        'conservation_sid',
        'identity',
        'attributes',
        'messaging_binding',
        'role_sid',
        'last_read_message_index',
        'last_read_timestamp',
    ];
}
