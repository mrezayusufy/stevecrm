@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.settings.users.title') }}
@stop
@section('title')
    {{ __('admin::app.settings.users.title') }}
@stop
@section('navbar-top')
<div class="flex px-10">
@if (bouncer()->hasPermission('settings.user.users.create'))
    <a href="{{ route('admin.settings.users.create') }}" class="btn btn-md btn-primary">
        {{ __('admin::app.settings.users.create-title') }}
    </a>
@endif
</div>
@stop

@section('content-wrapper')
    <div class="content full-page">
        <table-component data-src="{{ route('admin.settings.users.index') }}">
           
        <table-component>
    </div>
@stop
