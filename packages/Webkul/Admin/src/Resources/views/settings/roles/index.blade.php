@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.settings.roles.title') }}
@stop
@section('title')
    {{ __('admin::app.settings.roles.title') }}
@stop
@section('navbar-top')
<div class="flex px-10">
    @if (bouncer()->hasPermission('settings.user.roles.create'))
        <a href="{{ route('admin.settings.roles.create') }}" class="btn btn-md btn-primary">
            {{ __('admin::app.settings.roles.create-title') }}
        </a>
    @endif
</div>
@stop
@section('content-wrapper')
    <div class="content full-page">
        <table-component data-src="{{ route('admin.settings.roles.index') }}">
            
        <table-component>
    </div>
@stop
