<?php

namespace Webkul\Admin\Http\Controllers\Automation;

use Webkul\Admin\Http\Controllers\Controller;

class AutomationController extends Controller
{
    /**
     * Automation repository instance.
     *
     * @var \Webkul\Automation\Repositories\AutomationRepository
     */

    /**
     * Create a new controller instance.
     *
     * @param \Webkul\Automation\Repositories\AutomationRepository  $personRepository
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
        return view('admin::automation.index');
    }

}
