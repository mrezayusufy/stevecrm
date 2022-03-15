<?php

namespace Webkul\Automation\Repositories;

use Webkul\Core\Eloquent\Repository;

class TextTemplateRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Automation\Contracts\TextTemplate';
    }
}