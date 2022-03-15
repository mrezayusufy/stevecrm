<automation-action-component></automation-action-component>


@push('scripts')
    <script src="https://unpkg.com/vue-multiselect@2.1.0"></script>

    <script type="text/x-template" id="automation-action-component-template">
        <form action="{{ route('admin.automation.store') }}" method="post" data-vv-scope="automation-form" class="row"
            >
            <input type="hidden" name="lead_pipeline_stage_id" value="1" />
            @csrf()

            <div class="col-6">
                <div class="form-group d-none" :class="[errors.has('automation-form.type') ? 'has-error' : '']">
                    <label for="type" class="required form-label">{{ __('admin::app.automation.type') }}</label>
                    <select v-model="selectType" name="type" class="form-control" v-validate="'required'"
                        data-vv-as="&quot;{{ __('admin::app.automation.type') }}&quot;">
                        <option value="" disabled >{{ __('admin::app.automation.select-type') }}</option>
                        <option value="call">{{ __('admin::app.automation.call') }}</option>
                        <option value="message" selected>{{ __('admin::app.automation.message') }}</option>
                        <option value="email">{{ __('admin::app.automation.email') }}</option>
                    </select>
                    <span class="control-error" v-if="errors.has('automation-form.type')">
                        @{{ errors.first('automation-form.type') }}
                    </span>
                </div>
                <div class="form-group" :class="[errors.has('automation-form.title') ? 'has-error' : '']">
                    <label for="days_after" class="required form-label">Days after a lead Enters "NEW" stage</label>
                    <input name="days_after"
                        id="days_after"
                        class="form-control"
                        type="number"
                        v-validate="'required'"
                        data-vv-as="&quot;{{ __('admin::app.automation.title-control') }}&quot;" />
                    <span class="control-error" v-if="errors.has('automation-form.title')">
                        Please select a day.
                    </span>
                </div>
                <div class="form-group" :class="[errors.has('automation-form.type') ? 'has-error' : '']">
                    <label for="send_time" class="required form-label">Send text at</label>
                    <select name="send_time" id="send_time"  class="form-control" v-validate="'required'"
                        data-vv-as="&quot;Send text at&quot;">
                        <option value="" selected>immediately</option>
                        <option value="0">0AM EST</option>
                        <option value="1">1AM EST</option>
                        <option value="2">2AM EST</option>
                        <option value="3">3AM EST</option>
                        <option value="4">4AM EST</option>
                        <option value="5">5AM EST</option>
                        <option value="6">6AM EST</option>
                        <option value="7">7AM EST</option>
                        <option value="8">8AM EST</option>
                        <option value="9">9AM EST</option>
                        <option value="10">10AM EST</option>
                        <option value="11">11AM EST</option>
                        <option value="12">12PM EST</option>
                        <option value="1">1PM EST</option>
                        <option value="2">2PM EST</option>
                        <option value="3">3PM EST</option>
                        <option value="4">4PM EST</option>
                        <option value="5">5PM EST</option>
                        <option value="6">6PM EST</option>
                        <option value="7">7PM EST</option>
                        <option value="8">8PM EST</option>
                        <option value="9">9PM EST</option>
                        <option value="10">10PM EST</option>
                        <option value="11">11PM EST</option>
                    </select>
                    <span class="control-error" v-if="errors.has('automation-form.type')">
                        Please assign the time for sending
                    </span>
                </div>
                <div class="form-group">
                    <label class="form-label" for="include_tags_ids">Include these tags</label>
                    <multiselect
                        v-model="include_tags"
                        :options="include_tags_list"
                        id="include_tags_ids"
                        track-by="id"
                        label="name"
                        :searchable="true"
                        name="include_tags_ids[]"
                        :taggable="true"
                        :multiple="true">
                    </multiselect>
                </div>
                <div class="form-group">
                    <label class="form-label" for="exclude_tags_ids">Exclude these tags</label>
                    <multiselect
                        v-model="exclude_tags"
                        :options="exclude_tags_list"
                        id="exclude_tags_ids"
                        track-by="id"
                        label="name"
                        :searchable="true"
                        name="exclude_tags_ids[]"
                        :taggable="true"
                        :multiple="true">
                    </multiselect>
                </div>
            </div>

            <div class="col-6">
                <div class="row">
                    <div class="form-group col">
                        <label class="form-label" for="sender">{{ __('admin::app.automation.sender') }}</label>
                        <input name="sender" id="sender" value="1" class="form-control" />
                    </div>
                    <div class="form-group col">
                        <label class="form-label" for="recipient">{{ __('admin::app.automation.recipient') }}</label>
                        <input name="recipient" id="recipient" value="1" class="form-control" />
                    </div>
                </div>
                <div class="form-group" :class="[errors.has('automation-form.type') ? 'has-error' : '']">
                    <label for="text_template" class="required form-label">Text template</label>
                    <select name="text_template" class="form-control" v-validate="'required'"
                        data-vv-as="&quot;Text template&quot;">
                        <option value="4" selected>Create template</option>
                        <option value="1">Text template 1</option>
                        <option value="2">Text template 2</option>
                        <option value="3">Text template 3</option>
                    </select>
                </div>
                <div class="form-group" :class="[errors.has('automation-form.name') ? 'has-error' : '']">
                    <label for="template_name" class="required form-label">Template name</label>
                        <input name="template_name"
                        id="template_name"
                        class="form-control"
                        type="text"
                        v-validate="'required'"
                        data-vv-as="&quot;{{ __('admin::app.automation.title-control') }}&quot;" />
                    <span class="control-error" v-if="errors.has('automation-form.name')">
                        please enter template name
                    </span>
                </div>
                <div class="position-relative">
                    <div class="form-group">
                        <label class="form-label required" for="template_body">{{ __('admin::app.automation.message') }}</label>
                        <textarea class="form-control" id="template_body" name="template_body">{{ old('message') }}</textarea>
                    </div>
                    <select name="placeholders" class="position-absolute top right">
                        <option value="4" selected>placeholders</option>
                        <option value="1">Agent name</option>
                        <option value="2">Recipient Name</option>
                        <option value="3">Agency name</option>
                    </select>
                </div>


                <button type="submit" class="btn btn-md btn-primary">
                    {{ __('admin::app.automation.save-btn-title') }}
                </button>
            </div>

        </form>
    </script>

    <script>
        Vue.component('multiselect', window.VueMultiselect.default)

        Vue.component('automation-action-component', {

            template: '#automation-action-component-template',

            props: ['data'],

            inject: ['$validator'],

            data: function() {
                return {

                    selectType: "message",

                    include_tags: [{id: 1, name: 'not applied'}],
                    include_tags_list: [{id: 1, name: 'not applied' },{id: 2, name: 'Annual.Renewal'}, {id: 3, name: 'Annaul.Renewal.Text'}, {id: 4, name: 'New.Venture'}],

                    exclude_tags: [ {id: 1, name: 'not applied'} ],
                    exclude_tags_list: [{id: 1, name: 'not applied' },{id: 2, name: 'Annual.Renewal'}, {id: 3, name: 'Annaul.Renewal.Text'}, {id: 4, name: 'New.Venture'}]
                }
            },
            computed: {
                setPhone: function() {
                    return this.selectType === 'message' || this.selectType === 'call' ? this.phone : '';
                }
            },
            mounted: function() {
                var self = this;

            },

            methods: {
                addIncludeTag(newTag){
                    this.include_tags_list.push(newTag);
                    this.include_tags.push(newTag);
                },
                addExcludeTag(newTag){
                    this.exclude_tags_list.push(newTag);
                    this.exclude_tags.push(newTag);
                },
                onSubmit: function(e, formScope) {
                    this.$root.onSubmit(e, formScope);
                },

                search: debounce(function() {
                    this.is_searching = true;

                    if (this.search_term.length < 2) {
                        this.searched_participants = {
                            'users': [],

                            'persons': []
                        };

                        this.is_searching = false;

                        return;
                    }

                    this.$http.get("{{ route('admin.automation.search_participants') }}", {
                            params: {
                                query: this.search_term
                            }
                        })
                        .then(response => {
                            var self = this;

                            ['users', 'persons'].forEach(function(userType) {
                                self.participants[userType].forEach(function(addedUser) {

                                    response.data[userType].forEach(function(user,
                                        index) {
                                        if (user.id == addedUser.id) {
                                            response.data[userType].splice(
                                                index, 1);
                                        }
                                    });

                                });
                            });

                            this.searched_participants = response.data;

                            this.is_searching = false;
                        })
                        .catch(error => {
                            this.is_searching = false;
                        })
                }, 500),

                addParticipant: function(type, participant) {
                    this.search_term = '';

                    this.searched_participants = {
                        'users': [],

                        'persons': []
                    };

                    this.participants[type].push(participant);
                },

                removeParticipant: function(type, participant) {
                    const index = this.participants[type].indexOf(participant);

                    Vue.delete(this.participants[type], index);
                },

                checkIfOverlapping: function(e, formScope) {
                    var self = this;

                    this.$validator.validateAll(formScope).then(function(result) {
                        if (result) {
                            self.$http.post(`{{ route('admin.automation.check_overlapping') }}`, {
                                    schedule_from: self.schedule_from,
                                    schedule_to: self.schedule_to,
                                    participants: self.participants,
                                }).then(response => {
                                    if (!response.data.overlapping) {
                                        self.$root.onSubmit(e, formScope);
                                    } else {
                                        if (confirm(
                                                "{{ __('admin::app.automation.duration-overlapping') }}"
                                            )) {
                                            self.$root.onSubmit(e, formScope);
                                        }
                                    }
                                })
                                .catch(error => {});
                        }
                    });
                }
            }
        });
    </script>
@endpush
