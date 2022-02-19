<?php

namespace Webkul\Admin\Http\Controllers\Customer;

use Illuminate\Support\Facades\Event;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Attribute\Http\Requests\AttributeForm;
use Webkul\Customer\Repositories\CustomerRepository;

class CustomerController extends Controller
{
    /**
     * Customer repository instance.
     *
     * @var \Webkul\Customer\Repositories\CustomerRepository
     */
    protected $personRepository;

    /**
     * Create a new controller instance.
     *
     * @param \Webkul\Customer\Repositories\CustomerRepository  $personRepository
     *
     * @return void
     */
    public function __construct(CustomerRepository $personRepository)
    {
        $this->personRepository = $personRepository;

        request()->request->add(['entity_type' => 'persons']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        return view('admin::contacts.persons.index');
    }

}
