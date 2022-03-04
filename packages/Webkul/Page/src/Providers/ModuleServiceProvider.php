<?php

namespace Webkul\Page\Providers;
 
use Konekt\Concord\BaseModuleServiceProvider;
use Webkul\Page\Models\Page as PageModel;
class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        PageModel::class,
    ];
}