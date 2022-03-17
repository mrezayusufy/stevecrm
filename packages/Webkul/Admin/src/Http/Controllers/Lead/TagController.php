<?php

namespace Webkul\Admin\Http\Controllers\Lead;

use Illuminate\Support\Facades\Event;
use Webkul\Lead\Repositories\LeadRepository;
use Webkul\Tag\Repositories\TagRepository;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Tag\Models\Tag;

class TagController extends Controller
{
    /**
     * LeadRepository object
     *
     * @var \Webkul\Lead\Repositories\LeadRepository
     */
    protected $leadRepository;
    protected $tagRepository;

    /**
     * Create a new controller instance.
     *
     * @param \Webkul\Lead\Repositories\LeadRepository  $leadRepository
     *
     * @return void
     */
    public function __construct(LeadRepository $leadRepository, TagRepository $tagRepository)
    {
        $this->leadRepository = $leadRepository;
        $this->tagRepository = $tagRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        Event::dispatch('leads.tag.create.before', $id);

        $lead = $this->leadRepository->find($id);

        if (! $lead->tags->contains(request('id'))) {
            $lead->tags()->attach(request('id'));
        }

        Event::dispatch('leads.tag.create.after', $lead);

        return response()->json([
            'status'  => true,
            'message' => trans('admin::app.leads.tag-create-success'),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $leadId
     * @param  integer  $tagId
     * @return \Illuminate\Http\Response
     */
    public function delete($leadId)
    {
        Event::dispatch('leads.tag.delete.before', $leadId);

        $lead = $this->leadRepository->find($leadId);

        $lead->tags()->detach(request('tag_id'));

        Event::dispatch('leads.tag.delete.after', $lead);

        return response()->json([
            'status'  => true,
            'message' => trans('admin::app.leads.tag-destroy-success'),
        ], 200);
    }
    public function index() {
        $tags = Tag::get();
        return response()->json($tags);
    }
}
