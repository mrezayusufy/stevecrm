@extends('admin::layouts.master')

@section('page_title')
    Today's Task
@stop
@section('title')
    You have 0 Task Today
@stop
@section('navbar-top')
<div class="flex center g-10 px-10">
  <div class="pill bg-light grid column content-center fs-s hidden h-25 shadow-sm text-secondary" style="padding: 15px 5px;">
      <button class="px-10 p-5 pill lh-1 h-25 bg-primary btn btn-primary border-0">
          Dashboard
      </button>
      <button class="px-10 p-5 pill lh-1 h-25 bg-light border-0">
          List
      </button>
  </div>
  <button class="btn text-dark fs-x bg-white fs-l p-1 border-gray inline-block middle px-20">
      <i class="mdi mdi-magnify m-0 middle"></i> Filter
  </button>
  <button class="btn btn-primary fs-l p-1 border-0 inline-block middle px-20" style="--m:0 10px; --p: 10px;">
      <i class="mdi mdi-plus m-0 middle"></i> Task
  </button> 
</div>
@stop
@section('content-wrapper')
<div class="content full-page">
    <section class="flex row " >
        <div class="col flex column timeline">
            <div class="flex row relative items-center line mb-20">
                <button class="btn border bg-white text-gray z-2 pill" style="--bb: 2px solid #c2c2c2;"><i class="mdi mdi-chevron-right"></i></button>
                <div class="fs-xxl bold m-0 c" style="--m: 10px;">Past Due - Rotting (0)</div>
            </div>
            <div class="flex row relative items-center line mb-20">
                <button class="btn border bg-white text-gray z-2 pill" style="--bb: 2px solid #c2c2c2;"><i class="mdi mdi-chevron-right"></i></button>
                <div class="fs-xxl bold m-0 c" style="--m: 10px;">Past Due - Rotting (0)</div>
            </div>
            <div class="flex row relative items-center line mb-20">
                <button class="btn border bg-white text-gray z-2 pill" style="--bb: 2px solid #c2c2c2;"><i class="mdi mdi-chevron-right"></i></button>
                <div class="fs-xxl bold m-0 c" style="--m: 10px;">Today (0 left)</div>
            </div>
            <div class="flex row relative items-center line mb-20">
                <button class="btn border bg-white text-gray z-2 pill" style="--bb: 2px solid #c2c2c2;"><i class="mdi mdi-chevron-right"></i></button>
                <div class="fs-xxl bold m-0 c" style="--m: 10px;">Reminder of the week (0)</div>
            </div>
            <div class="flex row relative items-center line mb-20">
                <button class="btn border bg-white text-gray z-2 pill" style="--bb: 2px solid #c2c2c2;"><i class="mdi mdi-chevron-right"></i></button>
                <div class="fs-xxl bold m-0 c" style="--m: 10px;">next week (0)</div>
            </div>
            <div class="flex row relative items-center line-off mb-20">
                <button class="btn border bg-white text-gray z-2 pill" style="--bb: 2px solid #c2c2c2;"><i class="mdi mdi-chevron-right"></i></button>
                <div class="fs-xxl bold m-0 c" style="--m: 10px;">complated (0)</div>
            </div>
        </div>
        <div class="absolute right flex column px-10" >
            <div class="c bold fs-xl flex py-10 self-end">
                progress
                <div class="px-10 text-gray">0 / 0</div>
            </div>
            <div class="bg-gray square pill" style="--w: 300px; --h: 10px;">

            </div>
        </div>
    </section>
</div>
@stop
