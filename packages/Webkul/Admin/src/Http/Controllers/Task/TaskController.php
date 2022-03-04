<?php

namespace Webkul\Admin\Http\Controllers\Task;

use Illuminate\Support\Facades\Event;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Attribute\Http\Requests\AttributeForm;
use Webkul\Task\Repositories\TaskRepository;

class TaskController extends Controller
{
  protected $taskRepository;
  public function __construct(TaskRepository $taskRepository)
  {
    $this->taskRepository = $taskRepository;
    request()->request->add(['entity_type'=>'task']);
  }

  public function index()
  {
    if (request()->ajax()) {
      return app(\Webkul\Admin\DataGrids\Task\TaskDataGrid::class)->toJson();
    }
    return view('admin::task.index');
  }
  public function create()
  {
    return view('admin::task.create');
  }

  public function store(AttributeForm $request)
  {
    Event::dispatch('task.create.before');

    $task = $this->taskRepository->create(request()->all());

    Event::dispatch('task.create.after', $task);

    session()->flash('success', 'Task Created Successfully.');

    return redirect()->route('admin.task.index');
  }
  public function edit($id)
  {
    $task = $this->taskRepository->findOrFail($id);

    return view('admin::task.create', compact('task'));
  }
  public function update(AttributeForm $request, $id)
  {
    Event::dispatch('task.eAX.before', $id);

    $task = $this->taskRepository->update(request()->all(), $id);

    Event::dispatch('task.update.after', $task);

    session()->flash('success', "Task Updated Successfully.");

    return redirect()->route('admin.task.index');
  }
  public function destroy($id)
  {
    $this->taskRepository->findOrFail($id);

    try {
      Event::dispatch('settings.task.delete.before', $id);

      $this->taskRepository->delete($id);

      Event::dispatch('settings.task.delete.after', $id);

      return response()->json([
        'message' => trans('admin::app.response.destroy-success', ['name' => trans('admin::app.task.task')]),
      ], 200);
    } catch (\Exception $exception) {
      return response()->json([
        'message' => trans('admin::app.response.destroy-failed', ['name' => trans('admin::app.task.task')]),
      ], 400);
    }
  }
  public function massDestroy()
  {
    foreach (request('rows') as $taskId) {
      Event::dispatch('task.delete.before', $taskId);

      $this->taskRepository->delete($taskId);

      Event::dispatch('task.delete.after', $taskId);
    }

    return response()->json([
      'message' => trans('admin::app.response.destroy-success', ['name' => trans('admin::app.task.title')]),
    ]);
  }
}
