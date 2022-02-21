@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.settings.pipelines.title') }}
@stop
@section('title')
    {{ __('admin::app.settings.pipelines.title') }}
@stop
@section('navbar-top')
@if (bouncer()->hasPermission('settings.lead.pipelines.create'))
<div class="flex px-10">
    <button href="{{ route('admin.settings.pipelines.create') }}" class="btn btn-md btn-primary">
        {{ __('admin::app.settings.pipelines.create-title') }}
    </button>
</div>
@endif
@stop
@section('content-wrapper')
    <div class="content full-page">
        <table-component data-src="{{ route('admin.settings.pipelines.index') }}">
        <table-component>
    </div>
@stop
