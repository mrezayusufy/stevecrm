<?php

namespace Webkul\Page\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Page\Contracts\Page as PageContract;

class Page extends Model implements PageContract
{
    protected $fillable = [
        'title',
        'slug',
        'content',
    ];
}