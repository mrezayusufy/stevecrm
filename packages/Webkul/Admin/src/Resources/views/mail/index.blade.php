@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.mail.' . request('route')) }}
@stop
@section('title')
    {{ __('admin::app.mail.' . request('route')) }}
@stop

@section('content-wrapper')
    @include("admin::mail.chat")
@stop
