@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.products.title') }}
@stop
@section('title')
    {{ __('admin::app.products.title') }}
@stop
@section('navbar-top')
<div class="flex center g-10 px-10">
@if (bouncer()->hasPermission('products.create'))
    <a href="{{ route('admin.products.create') }}" class="btn btn-md btn-primary">{{ __('admin::app.products.create-title') }}</a>
@endif
</div>
@stop

@section('content-wrapper')
    <div class="content full-page">
        <table-component data-src="{{ route('admin.products.index') }}">
            
        <table-component>
    </div>
@stop
