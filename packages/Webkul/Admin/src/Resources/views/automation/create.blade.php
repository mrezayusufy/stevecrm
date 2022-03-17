@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.automation.title') }}
@stop
@section('title')
    {{ __('admin::app.automation.title') }}
@stop
@push('css')
    <link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
@endpush

@section('content-wrapper')
    <div class="content full-page bg-light h-auto">
        @include('admin::automation.automation-action')
    </div>
@stop

