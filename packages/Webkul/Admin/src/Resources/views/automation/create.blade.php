@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.automation.title') }}
@stop
@section('title')
    {{ __('admin::app.automation.title') }}
@stop
@push('css')
    <style>
        .calender::after {
            margin-top: -20px !important;
        }

    </style>
@endpush

@section('content-wrapper')
    <div class="content full-page bg-light h-auto">
        @include('admin::automation.automation-action')
    </div>
@stop
