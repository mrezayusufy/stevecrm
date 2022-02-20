<?php

namespace Webkul\Admin\Http\Controllers\Task;

use Webkul\Admin\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * Task repository instance.
     *
     * @var \Webkul\Task\Repositories\TaskRepository
     */

    /**
     * Create a new controller instance.
     *
     * @param \Webkul\Task\Repositories\TaskRepository  $personRepository
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
        return view('admin::task.index');
    }

}
