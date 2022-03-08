<?php

namespace Webkul\Message\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Message\Contracts\Message as MessageContract;

class Message extends Model implements MessageContract
{
    protected $fillable = [
        'to',
        'content'
    ];
}