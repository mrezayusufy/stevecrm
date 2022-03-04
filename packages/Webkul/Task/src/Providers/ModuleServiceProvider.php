<?php

namespace Webkul\Task\Providers;

use Webkul\Core\Providers\BaseModuleServiceProvider;
use Webkul\Task\Models\Task as TaskModel;
class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        TaskModel::class,
    ];
}