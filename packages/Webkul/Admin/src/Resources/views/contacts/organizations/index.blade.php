@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.contacts.organizations.title') }}
@stop
@section('title')
    {{ __('admin::app.contacts.organizations.title') }}
@stop
@section('navbar-top')
@if (bouncer()->hasPermission('contacts.organizations.create'))
<div class="flex center g-10 px-10">
    <a href="{{ route('admin.contacts.organizations.create') }}" class="btn btn-md btn-primary">{{ __('admin::app.contacts.organizations.create-title') }}</a>
</div>
@endif
@stop
@section('content-wrapper')
    <div class="content full-page">
        <table-component data-src="{{ route('admin.contacts.organizations.index') }}">

        <table-component>
    </div>
@stop
