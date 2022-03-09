@extends('admin::layouts.master')

@section('page_title')
    {{-- {{ __('admin::app.customer.title') }} --}}
    Lifecycle Automation
@stop
@section('title')
    Lifecycle Automation
@stop
@push('css')
    <style>
        .calender::after {
            margin-top: -20px !important;
        }

    </style>
@endpush
@section('navbar-top')
    <div class="flex center g-10 px-10">
        <button class="btn btn-outline-secondary d-flex align-items-center">
            Action <i class="mdi mdi-chevron-down m-0 middle"></i>
        </button>
        <button class="btn btn-outline-secondary d-flex align-items-center">
            <i class="mdi mdi-plus m-0 middle"></i> Add Shot Clock
        </button>
        <button class="btn btn-primary d-flex align-items-center">
            Add Automated Step <i class="mdi mdi-chevron-down"></i>
        </button>
    </div>
@stop

@section('content-wrapper')
    <div class="content full-page bg-light h-auto">

        @include('admin::automations.automation-action')
    </div>
@stop
