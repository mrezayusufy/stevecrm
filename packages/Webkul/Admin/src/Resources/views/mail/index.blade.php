@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.mail.' . request('route')) }}
@stop
@section('title')
    {{ __('admin::app.mail.' . request('route')) }}
@stop

@section('content-wrapper')
    <div class="content full-page">
        <table-component data-src="{{ route('admin.mail.index') }}">
        <table-component>
    </div>
@stop
