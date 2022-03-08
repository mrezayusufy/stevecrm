<?php

namespace Webkul\Message\Repositories;

use Webkul\Core\Eloquent\Repository;

class MessageRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Message\Contracts\Message';
    }
}