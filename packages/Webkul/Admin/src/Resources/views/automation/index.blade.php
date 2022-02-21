@extends('admin::layouts.master')

@section('page_title')
    {{-- {{ __('admin::app.customer.title') }} --}}
    Lifecycle Automation
@stop
@section('title')
    Lifecycle Automation
@stop
@section('navbar-top')
<div class="flex center g-10 px-10">
  <button class="btn text-dark fs-x bg-white fs-l p-1 border-gray inline-block middle px-20">
      Action <i class="mdi mdi-chevron-down m-0 middle"></i> 
  </button>
  <button class="btn text-dark fs-x bg-white fs-l p-1 border-gray inline-block middle px-20">
       <i class="mdi mdi-plus m-0 middle"></i> Add Shot Clock
  </button>
  <button class="btn btn-primary fs-l p-1 border-0 inline-block middle px-20" style="--m:0 10px; --p: 10px;">
      Add Automated Step <i class="mdi mdi-chevron-down m-0 middle"></i> 
  </button> 
</div>
@stop
@section('content-wrapper')
<div class="content full-page">
    this is lifecycle automation page
</div>
@stop
