@extends('admin::layouts.master')

@section('page_title')
    My 2022 Conversation
@stop
@section('title')
    My 2022 Conversation
@stop
@section('navbar-top')
<div class="flex g-10 center p-10">
    <div class="flex flex-row bg-light rounded-pill p-1 shadow-sm">
            <a href="#" class="btn rounded-pill btn-xs px-2 py-0">Emails</a>
            <a class="btn btn-primary rounded-pill btn-xs px-2 py-0 disabled" >Texts</a>
        </div>
</div>
@stop
@section('content-wrapper')
<div class="full-page content">
  this is conversation page
</div>
@stop
