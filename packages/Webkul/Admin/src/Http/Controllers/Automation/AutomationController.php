<?php

namespace Webkul\Admin\Http\Controllers\Automation;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Webkul\Automation\Repositories\AutomationRepository;
use Webkul\Automation\Repositories\TextTemplateRepository;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Contact\Repositories\PersonRepository;
use Webkul\Lead\Repositories\LeadRepository;
use Webkul\User\Repositories\UserRepository;

class AutomationController extends Controller
{
    /**
     * FileRepository object
     *
     * @var \Webkul\Automation\Repositories\FileRepository
     */
    protected $fileRepository;

    /**
     * AutomationRepository object
     *
     * @var \Webkul\Automation\Repositories\AutomationRepository
     */
    protected $automationRepository;

    /**
     * LeadRepository object
     *
     * @var \Webkul\Lead\Repositories\LeadRepository
     */
    protected $leadRepository;

    /**
     * UserRepository object
     *
     * @var \Webkul\User\Repositories\UserRepository
     */
    protected $userRepository;

    /**
     * PersonRepository object
     *
     * @var \Webkul\Contact\Repositories\PersonRepository
     */
    protected $personRepository;
    /**
     * PersonRepository object
     *
     * @var \Webkul\Contact\Repositories\TextTemplateRepository
     */
    protected $textTemplateRepository;

    /**
     * Create a new controller instance.
     *
     * @param \Webkul\Automation\Repositories\AutomationRepository  $automationRepository
     * @param \Webkul\Contact\Repositories\TextTemplateRepository  $textTemplateRepository
     * @param \Webkul\Automation\Repositories\FileRepository  $fileRepository
     * @param \Webkul\Automation\Repositories\LeadRepository  $leadRepository
     * @param \Webkul\User\Repositories\UserRepository  $userRepository
     * @param \Webkul\Contact\Repositories\PersonRepository  $personRepository
     *
     * @return void
     */
    public function __construct(
        AutomationRepository $automationRepository,
        TextTemplateRepository $textTemplateRepository,
        LeadRepository $leadRepository,
        UserRepository $userRepository,
        PersonRepository $personRepository
    ) {
        $this->automationRepository = $automationRepository;

        $this->textTemplateRepository = $textTemplateRepository;

        $this->leadRepository = $leadRepository;

        $this->userRepository = $userRepository;

        $this->personRepository = $personRepository;
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

    /**
     * Returns a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        if (request('view_type')) {
            $startDate = request()->get('startDate')
                ? Carbon::createFromTimeString(request()->get('startDate') . " 00:00:01")
                : Carbon::now()->startOfWeek()->format('Y-m-d H:i:s');

            $endDate = request()->get('endDate')
                ? Carbon::createFromTimeString(request()->get('endDate') . " 23:59:59")
                : Carbon::now()->endOfWeek()->format('Y-m-d H:i:s');

            $automations = $this->automationRepository->getActivities([$startDate, $endDate])->toArray();

            return response()->json([
                'automations' => $automations,
            ]);
        } else {
            return app(\Webkul\Admin\DataGrids\Automation\AutomationDataGrid::class)->toJson();
        }
    }

    /**
     * Check if automation duration is overlapping with another automation duration.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkIfOverlapping()
    {
        $isOverlapping = $this->automationRepository->isDurationOverlapping(
            request('schedule_from'),
            request('schedule_to'),
            request('participants'),
            request('id')
        );

        return response()->json([
            'overlapping' => $isOverlapping,
        ]);
    }
    public function create() {
        return view('admin::automation.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'type' => 'required'
        ]);

        Event::dispatch('automation.create.before');

        $text_template = $this->textTemplateRepository->create([
            'name' => request('template_name'),
            'body' => request('template_body')
        ]);
        $data = [];
        // dd(request()->all());

        $data['type'] = request('type');
        $data['days_after'] = request('days_after');
        $data['send_time'] = request('send_time');
        $data['include_tags_ids'] = implode(", ",request('include_tags_ids'));
        $data['exclude_tags_ids'] = implode(", ",request('exclude_tags_ids'));
        $data['recipient'] = request('recipient');
        $data['sender'] = request('sender');
        $data['lead_pipeline_stage_id'] = request('lead_pipeline_stage_id');
        $data['text_template_id'] = $text_template['id'];
        $automation = $this->automationRepository->create($data);
        Event::dispatch('automation.create.after', $automation);
        $data = request()->all();
        session()->flash('success', trans('admin::app.automation.create-success'));
        return redirect()->route('admin.automation.index');
    }

    public function getTextTemplates() {
        $text_template = $this->textTemplateRepository->find()->all();
        return response()->json($text_template);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $automation = $this->automationRepository->findOrFail($id);

        return view('admin::automation.edit', compact('automation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        Event::dispatch('automation.update.before', $id);

        $automation = $this->automationRepository->update(request()->all(), $id);

        if (request('participants')) {
            $automation->participants()->delete();

            if (is_array(request('participants.users'))) {
                foreach (request('participants.users') as $userId) {
                    $automation->participants()->create([
                        'user_id' => $userId
                    ]);
                }
            }

            if (is_array(request('participants.persons'))) {
                foreach (request('participants.persons') as $personId) {
                    $automation->participants()->create([
                        'person_id' => $personId,
                    ]);
                }
            }
        }

        if (request('lead_id')) {
            $lead = $this->leadRepository->find(request('lead_id'));

            if (!$lead->automations->contains($id)) {
                $lead->automations()->attach($id);
            }
        }

        Event::dispatch('automation.update.after', $automation);

        if (request()->ajax()) {
            return response()->json([
                'message' => trans('admin::app.automation.update-success', ['type' => trans('admin::app.automation.' . $automation->type)]),
            ]);
        } else {
            session()->flash('success', trans('admin::app.automation.update-success', ['type' => trans('admin::app.automation.' . $automation->type)]));

            return redirect()->route('admin.automation.index');
        }
    }

    /**
     * Mass Update the specified resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function massUpdate()
    {
        $count = 0;

        $data = request()->all();

        foreach (request('rows') as $automationId) {
            Event::dispatch('automation.update.before', $automationId);

            $automation = $this->automationRepository->update([
                'is_done' => request('value'),
            ], $automationId);

            Event::dispatch('automation.update.after', $automation);

            $count++;
        }

        if (!$count) {
            return response()->json([
                'message' => trans('admin::app.automation.mass-update-failed'),
            ], 400);
        }

        return response()->json([
            'message' => trans('admin::app.automation.mass-update-success'),
        ]);
    }

    /**
     * Search participants results
     *
     * @return \Illuminate\Http\Response
     */
    public function searchParticipants()
    {
        $users = $this->userRepository->findWhere([
            ['name', 'like', '%' . urldecode(request()->input('query')) . '%']
        ]);

        $persons = $this->personRepository->findWhere([
            ['name', 'like', '%' . urldecode(request()->input('query')) . '%']
        ]);

        return response()->json([
            'users'   => $users,
            'persons' => $persons,
        ]);
    }

    /**
     * Upload files to storage
     *
     * @return \Illuminate\View\View
     */
    public function upload()
    {
        $this->validate(request(), [
            'file' => 'required',
        ]);

        Event::dispatch('automation.file.create.before');

        $file = $this->fileRepository->upload(request()->all());

        if ($file) {
            if ($leadId = request('lead_id')) {
                $lead = $this->leadRepository->find($leadId);

                $lead->automations()->attach($file->automation->id);
            }

            Event::dispatch('automation.file.create.after', $file);

            session()->flash('success', trans('admin::app.automation.file-upload-success'));
        } else {
            session()->flash('error', trans('admin::app.automation.file-upload-error'));
        }

        return redirect()->back();
    }

    /**
     * Download file from storage
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function download($id)
    {
        $file = $this->fileRepository->findOrFail($id);

        return Storage::download($file->path);
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $automation = $this->automationRepository->findOrFail($id);

        try {
            Event::dispatch('automation.delete.before', $id);

            $this->automationRepository->delete($id);

            Event::dispatch('automation.delete.after', $id);

            return response()->json([
                'message' => trans('admin::app.automation.destroy-success', ['type' => trans('admin::app.automation.' . $automation->type)]),
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => trans('admin::app.automation.destroy-failed', ['type' => trans('admin::app.automation.' . $automation->type)]),
            ], 400);
        }
    }

    /**
     * Mass Delete the specified resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function massDestroy()
    {
        foreach (request('rows') as $automationId) {
            Event::dispatch('automation.delete.before', $automationId);

            $this->automationRepository->delete($automationId);

            Event::dispatch('automation.delete.after', $automationId);
        }

        return response()->json([
            'message' => trans('admin::app.response.destroy-success', ['name' => trans('admin::app.automation.title')])
        ]);
    }
}
