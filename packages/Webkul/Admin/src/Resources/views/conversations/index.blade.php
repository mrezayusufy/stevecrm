@extends('admin::layouts.master')

@section('page_title')
    My 2022 Conversation
@stop
@section('title')
    My 2022 Conversation
@stop

@section('content-wrapper')
  @include("admin::conversations.chat")
@stop
