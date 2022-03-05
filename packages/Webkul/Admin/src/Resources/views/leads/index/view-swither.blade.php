<div class="switch-pipeline-container">
    <div class="form-group m-0 px-10">
        @php
            $pipelineRepository = app('Webkul\Lead\Repositories\PipelineRepository');

            if (! $pipelineId = request('pipeline_id')) {
                $pipelineId = $pipelineRepository->getDefaultPipeline()->id;
            }
        @endphp
        
        <select class="control rounded px-2 p-0" onchange="window.location.href = this.value">
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
        <div class="flex flex-row bg-light rounded-pill p-1 shadow-sm">
            <a href="{{ route('admin.leads.index') }}" class="btn rounded-pill btn-xs px-2 py-0">Pipeline</a>
            <a class="btn btn-primary rounded-pill btn-xs px-2 py-0 disabled" >Table</a>
        </div>
    @else
        <div class="flex flex-row bg-light rounded-pill p-1 shadow-sm">
            <a class="btn btn-primary rounded-pill btn-xs px-2 py-0 disabled" >Pipeline</a>
            <a href="{{ route('admin.leads.index', ['view_type' => 'table']) }}" class="btn rounded-pill btn-xs px-2 py-0">Table</a>
        </div>
    @endif
</div>
