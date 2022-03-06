@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.customer.title') }}
@stop
@push('css')
    <style>
        .table-body, form {
            border: 0 !important;
        }
    </style>
@endpush
@section('title')
    {{ __('admin::app.customer.title') }}
@stop
@section('navbar-top')
    <div class="flex g-10 center p-10">
        <div class="flex flex-row bg-light rounded-pill p-1 shadow-sm text-secondary">
            <a href="#" class="btn rounded-pill btn-xs px-2 py-0">Customers</a>
            <a class="btn btn-primary rounded-pill btn-xs px-2 py-0 disabled">Policies</a>
        </div>
    </div>
@stop
@section('content-wrapper')
    <div class="content full-page">
        <div class="btn-group dropdown-open">
            <button class="btn fs-s bg-light border relative center text-dark fs-l dropdown-toggle d-flex n"
                style="--c: #ccc;">
                <i class="mdi mdi-filter px-10"></i>
                <div>All customers</div>
                <i class="mdi mdi-chevron-down px-10" style="--r:0;"></i>
                <div class="dropdown-list bottom-right left m-0 rounded hidden" style="--m: 2px;">
                    <ul class="p-0 m-0">
                        <li class="px-3 py-2 h-light uline">All Customers</li>
                        <li class="px-3 py-2 h-light uline text-primary d-flex align-items-center"> <i class="mdi mdi-plus "></i> Add A new Segment
                        </li>
                    </ul>
                </div>
            </button>
            <button class="btn bg-light center border fs-l inline-flex" style="--c: #ccc;">
                <i class="mdi mdi-pencil"></i>
            </button>
        </div>
        <table-component data-src="{{ route('admin.customers.index') }}" class="table"> </table-component>
    </div>
@stop

