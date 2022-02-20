@extends('admin::layouts.master')

@section('page_title')
    {{-- {{ __('admin::app.customer.title') }} --}}
    Reports
@stop
@section('title')
    {{-- {{ __('admin::app.customer.title') }} --}}
    Reports
@stop
@section('navbar-top')
<div class="flex g-10 px-10">
  <button class="btn btn-primary fs-l p-1 border-0 inline-block middle" style="--m:0 10px; --p: 10px;">
      <i class="mdi mdi-magnify m-0 middle"></i> Filter
  </button>
  <button class="btn text-dark fs-x bg-white fs-l p-1 border-gray inline-block middle">
      <i class="mdi mdi-cloud-download m-0 middle"></i> Export
  </button>
  <button class="btn text-dark fs-x bg-white fs-l p-1 border-gray inline-block middle">
      <i class="mdi mdi-printer m-0 middle"></i> Print
  </button>
</div>
@stop
@section('content-wrapper')
<div class="content full-page">
    this is report page
</div>
@stop
