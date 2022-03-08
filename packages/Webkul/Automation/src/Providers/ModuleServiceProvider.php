<?php

namespace Webkul\Automation\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Webkul\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\Automation\Models\Automation::class
    ];
}
