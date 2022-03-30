@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.settings.attributes.title') }}
@stop
@section('title')
    {{ __('admin::app.settings.attributes.title') }}
@stop
@section('navbar-top')
<div class="flex center g-10 px-10">
@if (bouncer()->hasPermission('settings.automation.attributes.create'))
    <a href="{{ route('admin.settings.attributes.create') }}" class="btn btn-md btn-primary">
        {{ __('admin::app.settings.attributes.create-title') }}
    </a>
@endif
</div>
@stop
@section('content-wrapper')
    <div class="content full-page">
        <table-component data-src="{{ route('admin.settings.attributes.index') }}">
        <table-component>
    </div>
@stop
