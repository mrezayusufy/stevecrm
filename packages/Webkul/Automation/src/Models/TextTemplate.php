<?php

namespace Webkul\Automation\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Automation\Contracts\TextTemplate as TextTemplateContract;

class TextTemplate extends Model implements TextTemplateContract
{
    protected $fillable = [
        'name',
        'body'
    ];
}
