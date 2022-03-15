@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.automation.title') }}
@stop
@section('title')
    {{ __('admin::app.automation.title') }}
@stop
@push('css')
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
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

