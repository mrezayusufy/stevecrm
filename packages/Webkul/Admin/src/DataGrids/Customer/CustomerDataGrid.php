<?php

namespace Webkul\Admin\DataGrids\Customer;

use Webkul\UI\DataGrid\DataGrid;
use Illuminate\Support\Facades\DB;

class CustomerDataGrid extends DataGrid
{
  /**
   * Prepare query builder.
   *
   * @return void
   */
  public function prepareQueryBuilder()
  {
    $queryBuilder = DB::table('customers')
      ->addSelect(
        'customers.id',
        'customers.name',
        'customers.tags',
        'customers.email',
        'customers.producer',
        'customers.policies',
        'customers.customer_since',
        'customers.wp_emailed',
        'customers.task_count',
      );

    $this->addFilter('id', 'customers.id');

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
      'index'    => 'name',
      'label'    => "Name",
      'type'     => 'string',
      'sortable' => true,
    ]);

    $this->addColumn([
      'index'    => 'tags',
      'label'    => "Tags",
      'type'     => 'string',
      'sortable' => true,
    ]);

    $this->addColumn([
      'index'    => 'email',
      'label'    => "Email",
      'type'     => 'string',
      'sortable' => true,
    ]);

    $this->addColumn([
      'index'    => 'producer',
      'label'    => 'Producer',
      'type'     => 'string',
      'sortable' => true,
    ]);

    $this->addColumn([
      'index'    => 'policies',
      'label'    => 'Policies',
      'type'     => 'string',
      'sortable' => true,
    ]);
    $this->addColumn([
      'index'    => 'customer_since',
      'label'    => 'Customer since',
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
      'route'  => 'admin.customers.update',
      'icon'   => 'pencil-icon',
    ]);

    $this->addAction([
      'title'        => "trans('ui::app.datagrid.delete')",
      'method'       => 'DELETE',
      'route'        => 'admin.customers.delete',
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
      'action' => route('admin.customers.mass_delete'),
      'method' => 'PUT',
    ]);
  }
}
