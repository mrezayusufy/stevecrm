<?php

namespace Webkul\Admin\Http\Controllers\Report;

use Webkul\Admin\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * Report repository instance.
     *
     * @var \Webkul\Report\Repositories\ReportRepository
     */

    /**
     * Create a new controller instance.
     *
     * @param \Webkul\Report\Repositories\ReportRepository  $personRepository
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
        return view('admin::reports.index');
    }

}
