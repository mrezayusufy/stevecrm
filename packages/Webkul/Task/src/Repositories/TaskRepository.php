<?php

namespace Webkul\Task\Repositories;

use Illuminate\Container\Container;
use Webkul\Core\Eloquent\Repository;
use Webkul\Attribute\Repositories\AttributeValueRepository;

class TaskRepository extends Repository
{
    protected $attributeValueRepository;

    public function __construct(
        AttributeValueRepository $attributeValueRepository,
        Container $container
    )
    {
        $this->attributeValueRepository = $attributeValueRepository;

        parent::__construct($container);
    }

    function model()
    {
        return 'Webkul\Task\Contracts\Task';
    }

    public function create(array $data)
    {
        $task = parent::create($data);

        $this->attributeValueRepository->save($data, $task->id);

        return $task;
    }

    public function update(array $data, $id, $attribute = "id")
    {
        $task = parent::update($data, $id);

        $this->attributeValueRepository->save($data, $id);

        return $task;
    }
 
}