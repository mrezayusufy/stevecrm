<?php

namespace Webkul\Sms\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Sms\Contracts\Sms as SmsContract;

class Sms extends Model implements SmsContract
{
    protected $fillable = [
        'to',
        'content'
    ];
}
