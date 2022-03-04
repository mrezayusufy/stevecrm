@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.customer.title') }}
@stop
@section('title')
    {{ __('admin::app.customer.title') }}
@stop
@section('content-wrapper')
<div class="content full-page adjacent-center">

        <form method="POST" action="{{ route('admin.customers.store') }}" @submit.prevent="onSubmit" enctype="multipart/form-data">

            <div class="page-content">
                <div class="form-container">

                    <div class="panel">
                        <div class="panel-header">
                            {!! view_render_event('admin.customer.create.form_buttons.before') !!}

                            <button type="submit" class="btn btn-md btn-primary">
                                {{ __('admin::app.customer.save-btn-title') }}
                            </button>

                            <a href="{{ route('admin.customers.index') }}">{{ __('admin::app.customer.back') }}</a>

                            {!! view_render_event('admin.customers.create.form_buttons.after') !!}
                        </div>
        
                        <div class="panel-body">
                            {!! view_render_event('admin.customers.create.form_controls.before') !!}

                            @csrf()

                            @include('admin::common.custom-attributes.edit', [
                                'customAttributes' => app('Webkul\Attribute\Repositories\AttributeRepository')->findWhere([
                                    'entity_type' => 'customers',
                                ]),
                            ])

                            {!! view_render_event('admin.customers.create.form_controls.after') !!}

                        </div>
                    </div>

                </div>

            </div>

        </form>

    </div>
@stop