@extends('admin::layouts.master')

@section('page_title')
    Chat
@stop
@section('title')
    Chat
@stop
@section('content-wrapper')
<div class="content full-page adjacent-center">
    @include("admin::chat.chat")
    <chat-component></chat-component>
</div>
@stop
