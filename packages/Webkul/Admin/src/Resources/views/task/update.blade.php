@extends('admin::layouts.master')

@section('page_title')
    Update Task
@stop
@section('title')
    Update Task
@stop

@section('content-wrapper')
    <section class="content full-page mb-4 px-5 h-auto d-flex flex-column col-6">
        <form action="">
          @include("admin::task.form")
        </form>
    </section>
@endsection
