@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.automation.title') }}
@stop
@section('title')
    Lifecycle Automation
@stop
@push('css')
    <style>
        .calender::after {
            margin-top: -20px !important;
        }

        .ms-x {
            --x: -30px;
            margin-left: var(--x);
        }

        .circle {
            margin-left: -30px;
        }

        .circle::after {
            content: "";
            background: #c2c2c2;
            height: 6px;
            width: 6px;
            position: absolute;
            border-radius: 50%;
            top: -10px;
            margin: 9px 2px;
        }

        .line {
            margin-left: -30px;
        }

        .line::after {
            content: "";
            background: #c2c2c2;
            width: 1px !important;
            border: .5px solid #c2c2c2;
            top: 0 !important;
            left: 4px;
            height: 100px;
        }

        grid {
            display: grid;
        }

        .g-row {
            grid-auto-flow: row;
        }

        .g-column {
            grid-auto-flow: column;
        }

        .columns {
            --columns: 1fr 1fr 1fr;
            grid-template-columns: var(--columns);
        }

    </style>
@endpush
@section('navbar-top')
    <div class="flex center g-10 px-10">
        <button class="btn btn-outline-secondary d-flex align-items-center">
            Action <i class="mdi mdi-chevron-down m-0 middle"></i>
        </button>
        <button class="btn btn-outline-secondary d-flex align-items-center">
            <i class="mdi mdi-plus m-0 middle"></i> Add Shot Clock
        </button>
        <a href="{{ route('admin.automation.create') }}" class="btn btn-primary d-flex align-items-center">
            Add Automated Step <i class="mdi mdi-chevron-down"></i>
        </a>
    </div>
@stop

@section('content-wrapper')
    <div class="content bg-light h-auto">
        <div class="d-flex flex-row ">
            {{-- sidebar --}}
            <div class="col-3 bg-white p-3">
                <div class="d-flex flex-column">
                    <details>
                        <summary
                            class="list-unstyled text-primary d-flex flex-row align-items-center btn btn-outline-primary justify-content-between border-0 rounded-0">
                            Prospecting <i class="mdi mdi-chevron-down"></i></summary>
                        <div class="py-3 d-flex flex-column ms-4">
                            <details>
                                <summary
                                    class="list-unstyled text-primary d-flex flex-row align-items-center btn btn-outline-primary justify-content-between border-0 rounded-0">
                                    Pipeline <i class="mdi mdi-chevron-down"></i></summary>
                                <div class="py-3 d-flex flex-column ms-4">
                                    <button class="btn btn-outline-primary border-0 rounded-0 text-start">NEW</button>
                                    <button
                                        class="btn btn-outline-primary border-0 rounded-0 text-start">Contracted</button>
                                    <button class="btn btn-outline-primary border-0 rounded-0 text-start">Waiting on
                                        Quote</button>
                                    <button class="btn btn-outline-primary border-0 rounded-0 text-start">Quoted</button>
                                    <button class="btn btn-outline-primary border-0 rounded-0 text-start">Quoted
                                        HOT</button>
                                </div>
                            </details>
                            <button class="btn btn-outline-primary text-start border-0 rounded-0">Smart-Cycle</button>
                        </div>
                    </details>
                    <details>
                        <summary
                            class="list-unstyled text-primary d-flex flex-row align-items-center btn btn-outline-primary justify-content-between border-0 rounded-0">
                            Onboarding <i class="mdi mdi-chevron-down"></i></summary>
                        <div>this is a test.</div>
                    </details>
                    <details>
                        <summary
                            class="list-unstyled text-primary d-flex flex-row align-items-center btn btn-outline-primary justify-content-between border-0 rounded-0">
                            Retain <i class="mdi mdi-chevron-down"></i></summary>
                        <div>this is a test.</div>
                    </details>
                    <button class="align-items-center border-0 rounded-0 btn btn-outline-primary d-flex flex-row"><i
                            class="mdi mdi-lock me-2"></i> Service</button>
                    <button class="align-items-center border-0 rounded-0 btn btn-outline-primary d-flex flex-row"><i
                            class="mdi mdi-lock me-2"></i> Events</button>
                </div>
            </div>
            {{-- automation content --}}
            <div class="col h-100">
                {{-- options --}}
                <div class="p-3 d-flex flex-row align-items-center">
                    <div class="btn-group dropup">
                        <button type="button"
                            class="n btn btn-outline-secondary dropdown-toggle d-flex flex-row align-items-center">
                            <i class="mdi mdi-filter pe-2"></i>
                            All
                            <i class="mdi mdi-chevron-down ps-2"></i>
                        </button>
                        <button type="button"
                            class="btn btn-outline-secondary rounded-end dropdown-toggle-split d-flex flex-row align-items-center n"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="mdi mdi-pencil"></span>
                        </button>
                        <div class="dropdown-list bottom-left w-100">
                            <div class="px-3 py-2">test menu</div>
                            <div class="px-3 py-2">test menu</div>
                            <div class="px-3 py-2">test menu</div>
                        </div>
                    </div>
                    <div class="ps-3">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="flexSwitchCheckChecked">Toggle All</label>
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                        </div>
                    </div>
                </div>
                {{-- timeline --}}
                <grid class="g-row me-3">
                    <grid class="g-column columns" style="--columns: 15% 80%;">
                        {{-- date --}}
                        <div
                            style="--w: 60px;"
                            class="bg-white square d-flex flex-column justify-content-center m-auto p-2 position-relative rounded shadow-sm text-center">
                            <div class="text-danger fs-4 lh-1">90</div>
                            <p class="fs-xs m-0">Biz Days</p>
                            <i class="mdi mdi-24px mdi-menu-right position-absolute end-0 text-white top-50"
                                style="margin-right: -14px;"></i>
                        </div>
                        {{-- automation content --}}
                        <div
                            class="mx-4 bg-white position-relative shadow-sm rounded d-flex flex-row p-4 align-items-center justify-content-between w-100">
                            <i class="circle position-absolute start-0 top-50"></i>
                            <i class="line position-absolute start-0 top-50"></i>

                            <i class="mdi mdi-24px mdi-menu-left position-absolute start-0 text-white top-50"
                                style="margin-left: -14px;"></i>
                            <div class="d-flex flex-row">
                                <div class="btn-circle bg-danger text-white"><i class="mdi mdi-alarm"></i></div>
                                <div class="ms-2">
                                    <p class="m-0">Aged Lead Shot Clock</p>
                                    <p class="text-gray fs-xs m-0">Move lead to "smart-cycle" and recycle after 9 months(s)
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="rounded-pill d-flex flex-row align-items-center bg-light btn me-2">
                                    <i class="mdi mdi-filter"></i>
                                    <span class="fs-xs ms-2">All Lead Types</span>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                </div>
                                <div class="btn p-0">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </div>
                            </div>
                        </div>
                    </grid>

                    <grid class="g-column columns" style="--columns: 15% 80%;">
                        {{-- date --}}
                        <div
                            class="bg-white d-flex flex-column justify-content-center m-auto p-2 position-relative rounded shadow-sm text-center">
                            <p class="fs-s m-0">START</p>
                            <i class="mdi mdi-24px mdi-menu-right position-absolute end-0 text-white top-50"
                                style="margin-right: -14px;"></i>
                        </div>
                        {{-- automation content --}}
                        <div class="ms-4 my-3 position-relative">
                            <i class="circle position-absolute start-0 top-50"></i>
                            <i class="line position-absolute start-0 top-50"></i>
                            <i class="align-items-center bg-primary z-2 d-flex ms-x d-inline-flex h-1 justify-content-center ms-x position-absolute rounded-pill start-0 top-0 w-1"
                                style="--w: 30px;--h: 30px; --x: -38px;">
                                <i class="mdi mdi-flag-checkered"></i>
                            </i>
                            Lead Enters NEW Stage
                        </div>
                    </grid>
                    <grid class="g-column columns" style="--columns: 15% 80%;">
                        {{-- date --}}
                        <div
                            style="--w: 60px;"
                            class="bg-white square d-flex flex-column justify-content-center m-auto mt-3 p-2 position-relative rounded shadow-sm text-center">
                            <p class="fs-xs m-0">Biz Days</p>
                            <div class="text-danger fs-4 lh-1">1</div>
                            <i class="mdi mdi-24px mdi-menu-right position-absolute end-0 text-white top-50"
                                style="margin-right: -14px;"></i>
                        </div>
                        {{-- automation content --}}
                        <grid class="g-row g-10">
                            <div
                                class="mx-4 bg-white position-relative shadow-sm rounded d-flex flex-row p-4 align-items-center justify-content-between w-100">
                                <i class="circle position-absolute start-0 top-50"></i>
                                <i class="line position-absolute start-0 top-0"></i>
                                <i class="mdi mdi-24px mdi-menu-left position-absolute start-0 text-white top-50"
                                    style="margin-left: -14px;"></i>
                                <div class="d-flex flex-row">
                                    <div class="btn-circle bg-primary text-white"><i class="mdi mdi-chat"></i></div>
                                    <div class="ms-2">
                                        <p class="m-0">Automated Text</p>
                                        <p class="text-gray fs-xs m-0">NewLead Text(2)</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-pill d-flex flex-row align-items-center bg-light btn me-2">
                                        <i class="mdi mdi-filter"></i>
                                        <span class="fs-xs ms-2">All Lead sources</span>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                    </div>
                                    <div class="btn p-0">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="mx-4 bg-white position-relative shadow-sm rounded d-flex flex-row p-4 align-items-center justify-content-between w-100">
                                <i class="circle position-absolute start-0 top-50"></i>
                                <i class="line position-absolute start-0 top-0"></i>
                                <i class="mdi mdi-24px mdi-menu-left position-absolute start-0 text-white top-50"
                                    style="margin-left: -14px;"></i>
                                <div class="d-flex flex-row">
                                    <div class="btn-circle bg-primary text-white"><i class="mdi mdi-chat"></i></div>
                                    <div class="ms-2">
                                        <p class="m-0">Automated Text</p>
                                        <p class="text-gray fs-xs m-0">NewLead Text(2)</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-pill d-flex flex-row align-items-center bg-light btn me-2">
                                        <i class="mdi mdi-filter"></i>
                                        <span class="fs-xs ms-2">All Lead sources</span>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                    </div>
                                    <div class="btn p-0">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="mx-4 bg-white position-relative shadow-sm rounded d-flex flex-row p-4 align-items-center justify-content-between w-100">
                                <i class="circle position-absolute start-0 top-50"></i>
                                <i class="line position-absolute start-0 top-0"></i>
                                <i class="mdi mdi-24px mdi-menu-left position-absolute start-0 text-white top-50"
                                    style="margin-left: -14px;"></i>
                                <div class="d-flex flex-row">
                                    <div class="btn-circle bg-primary text-white"><i class="mdi mdi-chat"></i></div>
                                    <div class="ms-2">
                                        <p class="m-0">Automated Text</p>
                                        <p class="text-gray fs-xs m-0">NewLead Text(2)</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-pill d-flex flex-row align-items-center bg-light btn me-2">
                                        <i class="mdi mdi-filter"></i>
                                        <span class="fs-xs ms-2">All Lead sources</span>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                    </div>
                                    <div class="btn p-0">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="mx-4 bg-white position-relative shadow-sm rounded d-flex flex-row p-4 align-items-center justify-content-between w-100">
                                <i class="circle position-absolute start-0 top-50"></i>
                                <i class="line position-absolute start-0 top-0"></i>
                                <i class="mdi mdi-24px mdi-menu-left position-absolute start-0 text-white top-50"
                                    style="margin-left: -14px;"></i>
                                <div class="d-flex flex-row">
                                    <div class="btn-circle bg-primary text-white"><i class="mdi mdi-chat"></i></div>
                                    <div class="ms-2">
                                        <p class="m-0">Automated Text</p>
                                        <p class="text-gray fs-xs m-0">NewLead Text(2)</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-pill d-flex flex-row align-items-center bg-light btn me-2">
                                        <i class="mdi mdi-filter"></i>
                                        <span class="fs-xs ms-2">All Lead sources</span>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                    </div>
                                    <div class="btn p-0">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="mx-4 bg-white position-relative shadow-sm rounded d-flex flex-row p-4 align-items-center justify-content-between w-100">
                                <i class="circle position-absolute start-0 top-50"></i>
                                <i class="line position-absolute start-0 top-0"></i>
                                <i class="mdi mdi-24px mdi-menu-left position-absolute start-0 text-white top-50"
                                    style="margin-left: -14px;"></i>
                                <div class="d-flex flex-row">
                                    <div class="btn-circle bg-primary text-white"><i class="mdi mdi-chat"></i></div>
                                    <div class="ms-2">
                                        <p class="m-0">Automated Text</p>
                                        <p class="text-gray fs-xs m-0">NewLead Text(2)</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-pill d-flex flex-row align-items-center bg-light btn me-2">
                                        <i class="mdi mdi-filter"></i>
                                        <span class="fs-xs ms-2">All Lead sources</span>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                    </div>
                                    <div class="btn p-0">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </div>
                                </div>
                            </div>
                        </grid>
                    </grid>
                </grid>
            </div>
        </div>
    </div>
@stop
