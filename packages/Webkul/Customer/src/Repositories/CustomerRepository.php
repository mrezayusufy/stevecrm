<?php

namespace Webkul\Customer\Repositories;

use Webkul\Core\Eloquent\Repository;

class CustomerRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Customer\Contracts\Customer';
    }

    // public function create(array $data)
    // {
    //     $customer = parent::create($data);

    //     $this->attributeValueRepository->save($data, $customer->id);

    //     return $customer;
    // }

    // public function update(array $data, $id, $attribute = "id")
    // {
    //     $result = parent::update($data, $id);

    //     $this->attributeValueRepository->save($data, $id);

    //     return $result;
    // }
}