<?php

namespace Webkul\Admin\Http\Controllers\Customer;

use Illuminate\Support\Facades\Event;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Attribute\Http\Requests\AttributeForm;
use Webkul\Customer\Repositories\CustomerRepository;

class CustomerController extends Controller
{
    protected $customerRepository;
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
        request()->request->add(['entity_type'=>'customers']);
    }

    public function index()
    {
        if(request()->ajax())
            return app(\Webkul\Admin\DataGrids\Customer\CustomerDataGrid::class)->toJson();
        return view('admin::customers.index');
    }

    public function create(){
        return view('admin::customers.create');
    }

    public function store(AttributeForm $request)
    {
        Event::dispatch('customer.create.before');

        $customer = $this->customerRepository->create(request()->all());

        Event::dispatch('customer.create.after', $customer);

        session()->flash('success', trans('admin::app.customer.create-success'));

        return redirect()->route('admin.customers.index');
    }
    public function edit($id)
    {
        $customer = $this->customerRepository->findOrFail($id);

        return view('admin::customers.edit', compact('customer'));
    }
    public function update(AttributeForm $request, $id)
    {
        Event::dispatch('customer.update.before', $id);

        $customer = $this->customerRepository->update(request()->all(), $id);

        Event::dispatch('customer.update.after', $customer);

        session()->flash('success', trans('admin::app.customer.update-success'));

        return redirect()->route('admin.customers.index');
    }
    public function search()
    {
        $results = $this->customerRepository->findWhere([
            ['name', 'like', '%' . urldecode(request()->input('query')) . '%']
        ]);

        return response()->json($results);
    }
    public function destroy($id)
    {
        $this->customerRepository->findOrFail($id);

        try {
            Event::dispatch('settings.customer.delete.before', $id);

            $this->customerRepository->delete($id);

            Event::dispatch('settings.customer.delete.after', $id);

            return response()->json([
                'message' => trans('admin::app.response.destroy-success', ['name' => trans('admin::app.customer.customer')]),
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => trans('admin::app.response.destroy-failed', ['name' => trans('admin::app.customer.customer')]),
            ], 400);
        }
    }
    public function massDestroy()
    {
        foreach (request('rows') as $customerId) {
            Event::dispatch('customer.delete.before', $customerId);

            $this->customerRepository->delete($customerId);

            Event::dispatch('customer.delete.after', $customerId);
        }

        return response()->json([
            'message' => trans('admin::app.response.destroy-success', ['name' => trans('admin::app.customer.title')]),
        ]);
    }
}
