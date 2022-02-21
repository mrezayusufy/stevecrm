@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.settings.workflows.title') }}
@stop
@section('title')
    {{ __('admin::app.settings.workflows.title') }}
@stop
@section('navbar-top')
<div class="flex px-10">
@if (bouncer()->hasPermission('settings.automation.workflows.create'))
    <a href="{{ route('admin.settings.workflows.create') }}" class="btn btn-md btn-primary">{{ __('admin::app.settings.workflows.create-title') }}</a>
@endif
</div>
@stop

@section('content-wrapper')
    <div class="content full-page">
        <table-component data-src="{{ route('admin.settings.workflows.index') }}">
            @if (bouncer()->hasPermission('settings.automation.workflows.create'))
                <template v-slot:table-action>
                    <a href="{{ route('admin.settings.workflows.create') }}" class="btn btn-md btn-primary">{{ __('admin::app.settings.workflows.create-title') }}</a>
                </template>
            @endif
        <table-component>
    </div>
@stop
