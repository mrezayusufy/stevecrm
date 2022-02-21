@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.settings.groups.title') }}
@stop
@section('title')
    {{ __('admin::app.settings.groups.title') }}
@stop
@section('navbar-top')
@if (bouncer()->hasPermission('settings.user.groups.create'))
    <a href="{{ route('admin.settings.groups.create') }}" class="btn btn-md btn-primary">
        {{ __('admin::app.settings.groups.create-title') }}
    </a>
@endif
@stop
@section('content-wrapper')
    <div class="content full-page">
        <table-component data-src="{{ route('admin.settings.groups.index') }}">

            @if (bouncer()->hasPermission('settings.user.groups.create'))
                <template v-slot:table-action>
                    <a href="{{ route('admin.settings.groups.create') }}" class="btn btn-md btn-primary">
                        {{ __('admin::app.settings.groups.create-title') }}
                    </a>
                </template>
            @endif
        <table-component>
    </div>
@stop
