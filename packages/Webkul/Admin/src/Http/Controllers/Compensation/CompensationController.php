<?php

namespace Webkul\Admin\Http\Controllers\Compensation;

use Webkul\Admin\Http\Controllers\Controller;

class CompensationController extends Controller
{
    /**
     * Compensation repository instance.
     *
     * @var \Webkul\Compensation\Repositories\CompensationRepository
     */

    /**
     * Create a new controller instance.
     *
     * @param \Webkul\Compensation\Repositories\CompensationRepository  $personRepository
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
        return view('admin::compensations.index');
    }

}
