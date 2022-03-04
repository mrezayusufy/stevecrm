<?php

namespace Webkul\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Customer\Contracts\Customer as CustomerContract;

class Customer extends Model implements CustomerContract
{
    protected $casts = [
        'tags' => 'array'
    ];
    protected $fillable = [
        'name',
        'tags',
        'email',
        'customer_since',
        'wp_email',
        'producer',
        'policies',
        'task_count', 
    ];
}