@extends('admin::layouts.master')

@section('page_title')
    Create Task
@stop
@section('title')
    Create Task
@stop

@section('content-wrapper')
    <section class="content full-page mb-4 px-5 h-auto d-flex flex-column col-6">
        <form method="POST" action="{{ route('admin.task.store') }}" @submit.prevent="onSubmit"
            enctype="multipart/form-data">
            {!! view_render_event('admin.task.create.form_controls.before') !!}

            @csrf()

            @include('admin::common.custom-attributes.edit', [
            'customAttributes' => app('Webkul\Attribute\Repositories\AttributeRepository')->findWhere([
            'entity_type' => 'tasks',
            ]),
            ])

            {!! view_render_event('admin.task.create.form_controls.after') !!}
            <button type="submit" class="btn btn-md btn-primary">
                {{ __('admin::app.quotes.save-btn-title') }}
            </button>
        </form>
    </section>
@endsection
