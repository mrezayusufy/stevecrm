<div class="content full-page">
    <div class="table">
        <div class="table-header">
            <h1>
                {!! view_render_event('admin.automations.index.header.before') !!}

                {{ Breadcrumbs::render('automations') }}

                {{ __('admin::app.automations.title') }}

                {!! view_render_event('admin.automations.index.header.after') !!}
            </h1>
        </div>

        <div class="calendar-body">

            <calendar-filters></calendar-filters>

            <calendar-component></calendar-component>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/x-template" id="calendar-filters-tempalte">
        <div class="form-group datagrid-filters">
            <div></div>
            
            <div class="filter-right">

                @include('admin::automations.index.view-swither')

            </div>

        </div>
    </script>

    <script type="text/x-template" id="calendar-component-tempalte">
        <div class="calendar-container">

            <vue-cal
                hide-view-selector
                :watchRealTime="true"
                :twelveHour="true"
                :disable-views="['years', 'year', 'month', 'day']"
                style="height: calc(100vh - 240px);"
                :events="events"
                @ready="getAutomations"
                @view-change="getAutomations"
                :on-event-click="onEventClick"
            />

        </div>
    </script>

    <script>
        Vue.component('calendar-filters', {
            template: '#calendar-filters-tempalte',
        });


        Vue.component('calendar-component', {
            template: '#calendar-component-tempalte',
            
            data: function () {
                return {
                    events: []
                }
            },

            methods: {
                getAutomations: function ({startDate, endDate}) {
                    this.$root.pageLoaded = false;

                    this.$http.get("{{ route('admin.automations.get', ['view_type' => 'calendar']) }}" + `&startDate=${new Date(startDate).toLocaleDateString("en-US")}&endDate=${new Date(endDate).toLocaleDateString("en-US")}`)
                        .then(response => {
                            this.$root.pageLoaded = true;

                            this.events = response.data.automations;
                        })
                        .catch(error => {
                            this.$root.pageLoaded = true;
                        });
                },

                onEventClick : function (event) {
                    window.location.href = "{{ route('admin.automations.edit') }}/" + event.id
                }
            }
        });
    </script>
@endpush