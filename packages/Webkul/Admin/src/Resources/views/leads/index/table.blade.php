@push('css')
    <style>
        .table-header {
            margin: 0!important;
        }

    </style>
@endpush
@section('title')
{{ __('admin::app.leads.title') }}
@stop
@section('navbar-top')
@if (bouncer()->hasPermission('leads.create'))
    @include('admin::leads.index.view-swither')
    <a href="{{ route('admin.leads.create') }}" class="btn btn-primary mx-2 d-flex align-items-center">
        <i class="mdi mdi-plus pe-2 d-flex justify-content-center"></i>
        {{ __('admin::app.leads.title') }}
    </a>
@endif
@stop

<div class="content full-page">
    <table-component data-src="{{ route('admin.leads.get') }}" switch-page-url="{{ route('admin.leads.index') }}">

    <table-component>
</div>
