@extends('admin::layouts.master')

@section('page_title')
    My 2022 Conversation
@stop
@section('title')
    My 2022 Conversation
@stop
@section('navbar-top')
<div class="flex g-10 center p-10">
    <div class="pill bg-light grid column content-center fs-s hidden h-25 shadow-sm text-secondary c" style="padding: 15px 5px;">
        <a href="#" class="px-10 p-5 pill lh-1 h-25 bg-primary btn btn-primary border-0">
            emails
        </a>
        <a class="px-10 p-5 pill lh-1 h-25">
            texts
        </a>
    </div>
</div>
@stop
@section('content-wrapper')
<div class="full-page content">
  this is conversation page
</div>
@stop
