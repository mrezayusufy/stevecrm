<div class="switch-pipeline-container">
    <div class="form-group m-0 px-10">
        @php
            $pipelineRepository = app('Webkul\Lead\Repositories\PipelineRepository');

            if (! $pipelineId = request('pipeline_id')) {
                $pipelineId = $pipelineRepository->getDefaultPipeline()->id;
            }
        @endphp

        <select class="control rounded " onchange="window.location.href = this.value">
            @foreach (app('Webkul\Lead\Repositories\PipelineRepository')->all() as $pipeline)
                @php
                    if ($viewType = request('view_type')) {
                        $url = route('admin.leads.index', [
                            'pipeline_id' => $pipeline->id,
                            'view_type'   => $viewType
                        ]);
                    } else {
                        $url = route('admin.leads.index', ['pipeline_id' => $pipeline->id]);
                    }
                @endphp

                <option value="{{ $url }}" {{ $pipelineId == $pipeline->id ? 'selected' : '' }}>
                    {{ $pipeline->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="switch-view-container">
    @if (request('view_type'))
        <div class="pill bg-light grid column content-center fs-s hidden h-25 shadow-sm text-secondary" style="padding: 15px 5px;">
            <a href="{{ route('admin.leads.index') }}" class="px-10 p-5 pill lh-1 h-25 ">
                Pipeline
            </a>
            <a class="px-10 p-5 pill lh-1 h-25 bg-primary btn btn-primary border-0">
                Table
            </a>
        </div>
    @else
        <div class="pill bg-light grid column content-center fs-s hidden h-25 shadow-sm text-secondary" style="padding: 15px 5px;">
            <a class="px-10 p-5 pill lh-1 h-25 bg-primary btn btn-primary border-0">
                Pipeline
            </a>
            <a href="{{ route('admin.leads.index', ['view_type' => 'table']) }}" class="px-10 p-5 pill lh-1 h-25">
                Table
            </a>
        </div>
    @endif
</div>
