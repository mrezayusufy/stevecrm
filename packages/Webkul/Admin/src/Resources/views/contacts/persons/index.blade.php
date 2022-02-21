@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.contacts.persons.title') }}
@stop
@section('title')
    {{ __('admin::app.contacts.persons.title') }}
@stop
@section('navbar-top')
<div class="flex center g-10 px-10">
@if (bouncer()->hasPermission('contacts.persons.create'))
<a href="{{ route('admin.contacts.persons.create') }}" class="btn btn-md btn-primary">{{ __('admin::app.contacts.persons.create-title') }}</a>
@endif
</div>
@stop
@section('content-wrapper')
    <div class="content full-page">
        <table-component data-src="{{ route('admin.contacts.persons.index') }}">
            
        <table-component>
    </div>
@stop
