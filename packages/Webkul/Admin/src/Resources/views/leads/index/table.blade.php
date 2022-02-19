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
    <a href="{{ route('admin.leads.create') }}" class="btn btn-primary fs-xl m-0 p-1 border-0 inline-block middle" style="--m:0 10px; --p: 10px;">
        <i class="mdi mdi-plus m-0 middle"></i>
        {{ __('admin::app.leads.title') }}
    </a>
@endif
@stop

<div class="content full-page">
    <table-component data-src="{{ route('admin.leads.get') }}" switch-page-url="{{ route('admin.leads.index') }}">
        <template v-slot:extra-filters>
            @include('admin::leads.index.view-swither')
        </template>
    <table-component>
</div>
