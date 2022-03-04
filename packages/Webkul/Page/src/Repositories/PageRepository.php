<?php

namespace Webkul\Page\Repositories;

use Webkul\Core\Eloquent\Repository;
use Webkul\Page\Contracts\Page as PageContract;
class PageRepository extends Repository
{
 
    function model()
    {
        return 'Webkul\Page\Contracts\Page';
    }
}