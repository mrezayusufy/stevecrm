@extends('admin::layouts.master')

@section('page_title')
    {{-- {{ __('admin::app.customer.title') }} --}}
    Today's Task
@stop
@section('title')
    You have 0 Task Today
@stop
@section('navbar-top')
<div class="flex center g-10 px-10">
  <div class="pill bg-light grid column content-center fs-s hidden h-25 shadow-sm text-secondary" style="padding: 15px 5px;">
      <button class="px-10 p-5 pill lh-1 h-25 bg-primary btn btn-primary border-0">
          Dashboard
      </button>
      <button class="px-10 p-5 pill lh-1 h-25 bg-light border-0">
          List
      </button>
  </div>
  <button class="btn text-dark fs-x bg-white fs-l p-1 border-gray inline-block middle">
      <i class="mdi mdi-magnify m-0 middle"></i> Filter
  </button>
  <button class="btn btn-primary fs-l p-1 border-0 inline-block middle" style="--m:0 10px; --p: 10px;">
      <i class="mdi mdi-plus m-0 middle"></i> Task
  </button> 
</div>
@stop
@section('content-wrapper')
<div class="content full-page">
    this is report page
</div>
@stop
