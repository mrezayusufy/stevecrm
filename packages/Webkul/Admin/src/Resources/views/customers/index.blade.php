@extends('admin::layouts.master')

@section('page_title')
    {{-- {{ __('admin::app.customer.title') }} --}}
    All customers
@stop
@section('title')
    {{-- {{ __('admin::app.customer.title') }} --}}
    All customers
@stop
@section('navbar-top')
<div class="pill bg-light grid column content-center fs-s hidden h-25 shadow-sm text-secondary" style="padding: 15px 5px;">
    <a href="#" class="px-10 p-5 pill lh-1 h-25 bg-primary btn btn-primary border-0">
        Customers
    </a>
    <a class="px-10 p-5 pill lh-1 h-25 ">
        Policies
    </a>
</div>
@stop
@section('content-wrapper')
<div class="content full-page">
this is a test
</div>
@stop