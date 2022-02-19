<?php

namespace Webkul\Admin\Http\Controllers\Customer;

use Webkul\Admin\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Customer repository instance.
     *
     * @var \Webkul\Customer\Repositories\CustomerRepository
     */

    /**
     * Create a new controller instance.
     *
     * @param \Webkul\Customer\Repositories\CustomerRepository  $personRepository
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin::customers.index');
    }

}
