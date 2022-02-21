@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.settings.email-templates.title') }}
@stop
@section('title')
    {{ __('admin::app.settings.email-templates.title') }}
@stop
@section('navbar-top')
<div class="flex px-10">
    @if (bouncer()->hasPermission('settings.automation.email_templates.create'))
        <template v-slot:table-action>
            <a href="{{ route('admin.settings.email_templates.create') }}" class="btn btn-md btn-primary">{{ __('admin::app.settings.email-templates.create-title') }}</a>
        </template>
    @endif
</div>
@stop

@section('content-wrapper')
    <div class="content full-page">
        <table-component data-src="{{ route('admin.settings.email_templates.index') }}">

           
        <table-component>
    </div>
@stop
