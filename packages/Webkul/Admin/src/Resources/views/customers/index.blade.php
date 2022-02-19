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
<div class="flex g-10 center p-10">
    <div class="pill bg-light grid column content-center fs-s hidden h-25 shadow-sm text-secondary" style="padding: 15px 5px;">
        <a href="#" class="px-10 p-5 pill lh-1 h-25 bg-primary btn btn-primary border-0">
            Customers
        </a>
        <a class="px-10 p-5 pill lh-1 h-25 ">
            Policies
        </a>
    </div>
    <div class="form-group datagrid-filters flex center m-0 flex-end w-auto">
        <div class="search-filter relative">
            <i class="icon search-icon absolute m-0" style="--m:10px;"></i>
            <input
                type="search"
                class="control rounded p-1 m-0" style="--l: 35px;"
                id="search-field"
                placeholder="search for customers"
            />
        </div>
    </div>
</div>
@stop
@section('content-wrapper')
<div class="content full-page">
    
</div>
@stop