<?php

namespace Webkul\Admin\Http\Controllers\Page;

use Illuminate\Support\Facades\Event;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Attribute\Http\Requests\AttributeForm;
use Webkul\Page\Repositories\PageRepository;

class PageController extends Controller
{
  /**
   * PageRepository object
   *
   * @var \Webkul\Page\Repositories\PageRepository
   */
  protected $pageRepository;

  /**
   * Create a new controller instance.
   *
   * @param \Webkul\Page\src\Repositories\PageRepository  $pageRepository
   *
   * @return void
   */
  public function __construct(PageRepository $pageRepository)
  {
    $this->pageRepository = $pageRepository;

    request()->request->add(['entity_type' => 'pages']);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\View\View
   */
  public function index()
  {
    return view('admin::pages.index');
  }
 
  public function create()
  {
    return view('admin::pages.create');
  }
 
  public function store(AttributeForm $request)
  {
    Event::dispatch('page.create.before');

    $page = $this->pageRepository->create(request()->all());

    Event::dispatch('page.create.after', $page);

    session()->flash('success', trans('admin::app.pages.create-success'));

    return redirect()->route('admin.pages.index');
  }
 
}
