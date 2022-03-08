@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.configuration.twilio') }}
@stop
@section('title')
    {{ __('admin::app.configuration.twilio') }}
@stop

@section('content-wrapper')
    <div class="content full-page adjacent-center">
        <form method="POST" action="{{ route('admin.configuration.twilio.store') }}" @submit.prevent="onSubmit"
            enctype="multipart/form-data">
            <div class="page-content">
                <div class="form-container">

                    <div class="panel">
                        <div class="panel-header">
                            <button type="submit" class="btn btn-md btn-primary">
                                {{ __('admin::app.configuration.save-btn-title') }}
                            </button>
                        </div>

                        @csrf()

                        <div class="col-5">
                            @foreach ($fields as $field)
                                <div class="mb-3">
                                    <label for="{{ $field['name'] }}"
                                        class="form-lable">{{ $field['title'] }}</label>
                                    <input type="text" name="{{ $field['name'] }}"
                                        value="{{ $field['default_value'] }}" id="twilio.setting.{{ $field['name'] }}"
                                        class="form-control" />
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
