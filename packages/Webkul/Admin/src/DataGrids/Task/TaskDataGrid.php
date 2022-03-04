<?php

namespace Webkul\Admin\DataGrids\Task;

use Webkul\UI\DataGrid\DataGrid;
use Illuminate\Support\Facades\DB;

class TaskDataGrid extends DataGrid
{
  /**
   * Prepare query builder.
   *
   * @return void
   */
  public function prepareQueryBuilder()
  {
    $queryBuilder = DB::table('tasks')
      ->addSelect(
        'tasks.id',
        'tasks.title',
        'tasks.date',
        'tasks.time',
        'tasks.duration',
        'tasks.location',
        'tasks.assign_to',
        'tasks.link_to',
        'tasks.associate_with',
        'tasks.send_notification',
        'tasks.notification_from',
        'tasks.invite',
        'tasks.notes',
        'tasks.subtask',
      );

    $this->addFilter('id', 'tasks.id');

    $this->setQueryBuilder($queryBuilder);
  }

  /**
   * Add columns.
   *
   * @return void
   */
  public function addColumns()
  {
    $this->addColumn([
      'index'    => 'title',
      'label'    => "title",
      'type'     => 'string',
      'sortable' => true,
    ]);

    $this->addColumn([
      'index'    => 'date',
      'label'    => "date",
      'type'     => 'date',
      'sortable' => true,
    ]);

    $this->addColumn([
      'index'    => 'assign_to',
      'label'    => "assign_to",
      'type'     => 'string',
      'sortable' => true,
    ]);

    $this->addColumn([
      'index'    => 'notes',
      'label'    => 'notes',
      'type'     => 'string',
      'sortable' => true,
    ]);
  }

  /**
   * Prepare actions.
   *
   * @return void
   */
  public function prepareActions()
  {
    $this->addAction([
      'title'  => "update",
      'method' => 'POST',
      'route'  => 'admin.task.update',
      'icon'   => 'pencil-icon',
    ]);

    $this->addAction([
      'title'        => "trans('ui::app.datagrid.delete')",
      'method'       => 'DELETE',
      'route'        => 'admin.task.delete',
      'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'user']),
      'icon'         => 'trash-icon',
    ]);
  }

  /**
   * Prepare mass actions.
   *
   * @return void
   */
  public function prepareMassActions()
  {
    $this->addMassAction([
      'type'   => 'delete',
      'label'  => trans('ui::app.datagrid.delete'),
      'action' => route('admin.task.mass_delete'),
      'method' => 'PUT',
    ]);
  }
}
