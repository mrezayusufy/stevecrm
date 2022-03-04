@extends('admin::layouts.master')

@section('page_title')
    Today's Task
@stop
@section('title')
    You have 0 Task Today
@stop
@section('navbar-top')

    <div class="flex center g-10 px-10">
        <div class="flex flex-row bg-light rounded-pill p-1 shadow-sm">
            <a href="#" class="btn rounded-pill btn-xs px-2 py-0">Dashboard</a>
            <a class="btn btn-primary rounded-pill btn-xs px-2 py-0 disabled">List</a>
        </div>
        <button class="btn btn-outline-secondary d-flex align-items-center">
            <i class="mdi mdi-magnify pe-2 middle"></i> Filter
        </button>
        <button class="btn btn-primary d-flex align-items-center" onclick="onRoute('/admin/task/create')">
            <i class="mdi mdi-plus pe-2"></i> Task
        </button>
    </div>
@stop
@section('content-wrapper')
    <div class="content full-page">
        <section class=" flex-row d-none">
            <div class="col d-flex flex-column timeline">
                <div class="d-flex flex-row relative items-center line mb-20">
                    <button class="btn btn-circle btn-secondary-outline pill z-2"><i
                            class="mdi mdi-chevron-right mdi-24px d-flex justify-center"></i></button>
                    <div class="fs-xxl bold m-0 mx-4 c">Past Due - Rotting (0)</div>
                </div>
                <div class="d-flex flex-row relative items-center line mb-20">
                    <button class="btn btn-circle btn-secondary-outline pill z-2"><i
                            class="mdi mdi-chevron-right mdi-24px d-flex justify-center"></i></button>
                    <div class="fs-xxl bold m-0 mx-4 c">Past Due - Rotting (0)</div>
                </div>
                <div class="d-flex flex-row relative items-center line mb-20">
                    <button class="btn btn-circle btn-secondary-outline pill z-2"><i
                            class="mdi mdi-chevron-right mdi-24px d-flex justify-center"></i></button>
                    <div class="fs-xxl bold m-0 mx-4 c">Today (0 left)</div>
                </div>
                <div class="d-flex flex-row relative items-center line mb-20">
                    <button class="btn btn-circle btn-secondary-outline pill z-2"><i
                            class="mdi mdi-chevron-right mdi-24px d-flex justify-center"></i></button>
                    <div class="fs-xxl bold m-0 mx-4 c">Reminder of the week (0)</div>
                </div>
                <div class="d-flex flex-row relative items-center line mb-20">
                    <button class="btn btn-circle btn-secondary-outline pill z-2"><i
                            class="mdi mdi-chevron-right mdi-24px d-flex justify-center"></i></button>
                    <div class="fs-xxl bold m-0 mx-4 c">next week (0)</div>
                </div>
                <div class="d-flex flex-row relative items-center line-off mb-20">
                    <button class="btn btn-circle btn-secondary-outline pill z-2"><i
                            class="mdi mdi-chevron-right mdi-24px d-flex justify-center"></i></button>
                    <div class="fs-xxl bold m-0 mx-4 c">complated (0)</div>
                </div>
            </div>
            <div class="absolute right flex column px-10">
                <div class="c bold fs-xl flex py-10 self-end" style="--t: 0;">
                    progress
                    <div class="px-10 text-gray">0 / 0</div>
                </div>
                <div class="bg-gray square pill" style="--w: 300px; --h: 10px;"></div>
            </div>
        </section>
        <table-component data-src="{{ route('admin.task.index') }}"> </table-component>
    </div>

@stop
@push('scripts')
    <script>
        const onRoute = (url) => {
            window.location = url;
        };

        function showCreateModal() {
            var modal = document.getElementById("createTaskModal");
            modal.classList.add("show");
            modal.setAttribute('aria-modal', 'true');
            modal.setAttribute('role', 'dialog');
            modal.removeAttribute('aria-hidden');
        }

        function closeCreateModal() {
            var modal = document.getElementById("createTaskModal");
            modal.classList.remove("show");
            modal.removeAttribute('aria-modal', 'true');
            modal.removeAttribute('role', 'dialog');
            modal.setAttribute('aria-hidden', 'true');
        }
    </script>
@endpush
