<?php

namespace Webkul\Admin\Http\Controllers\Conversation;

use Webkul\Admin\Http\Controllers\Controller;

class ConversationController extends Controller
{
    /**
     * Conversation repository instance.
     *
     * @var \Webkul\Conversation\Repositories\ConversationRepository
     */

    /**
     * Create a new controller instance.
     *
     * @param \Webkul\Conversation\Repositories\ConversationRepository  $personRepository
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
        return view('admin::conversations.index');
    }

}
