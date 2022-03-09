<automation-action-component></automation-action-component>


@push('scripts')
    <script type="text/x-template" id="automation-action-component-template">
        <form action="{{ route('admin.automations.store') }}" method="post" data-vv-scope="automation-form" class="col-5"
            @submit.prevent="checkIfOverlapping($event, 'automation-form')">

            <input type="hidden" name="lead_id" value="">

            @csrf()

            <div class="form-group" :class="[errors.has('automation-form.type') ? 'has-error' : '']">
                <label for="type" class="required form-label">{{ __('admin::app.automations.type') }}</label>

                <select v-model="selectType" name="type" class="form-control" v-validate="'required'"
                    data-vv-as="&quot;{{ __('admin::app.automations.type') }}&quot;">
                    <option value="" disabled >{{ __('admin::app.automations.select-type') }}</option>
                    <option value="call">{{ __('admin::app.automations.call') }}</option>
                    <option value="message" selected>{{ __('admin::app.automations.message') }}</option>
                    <option value="meeting">{{ __('admin::app.automations.meeting') }}</option>
                    <option value="lunch">{{ __('admin::app.automations.lunch') }}</option>
                </select>

                <span class="control-error" v-if="errors.has('automation-form.type')">
                    @{{ errors.first('automation-form.type') }}
                </span>
            </div>

            <div class="form-group" :class="[errors.has('automation-form.title') ? 'has-error' : '']">
                <label for="title" class="required form-label">@{{ selectType === 'message' || selectType === 'call' ? 'Phone' : 'Title' }}</label>
                <input name="title" 
                    class="form-control" 
                    v-validate="'required'"
                    data-vv-as="&quot;{{ __('admin::app.automations.title-control') }}&quot;" />
                <span class="control-error" v-if="errors.has('automation-form.title')">
                    @{{ errors.first('automation-form.title') }}
                </span>
            </div>
            
            <div class="form-group">
                <label class="form-label required" for="comment">{{ __('admin::app.automations.message') }}</label>

                <textarea class="form-control" id="automation-comment" name="comment">{{ old('comment') }}</textarea>
            </div>
            
            <div class="form-group date"
                :class="[errors.has('automation-form.schedule_from') || errors.has('automation-form.schedule_to') ? 'has-error' : '']">
                <label for="schedule_from" class=" form-label">{{ __('admin::app.automations.schedule') }}</label>

                <div class="input-group d-flex">
                    
                    <datetime class="calender">
                        <input type="text" name="schedule_from" class="form-control" v-model="schedule_from" ref="schedule_from"
                            placeholder="{{ __('admin::app.automations.from') }}"
                            v-validate="'date_format:yyyy-MM-dd HH:mm:ss|after:schedule_from'"
                            data-vv-as="&quot;{{ __('admin::app.automations.from') }}&quot;" />
                            <div class="mdi mdi-calender absolute"></div>
                            @{{ errors.first('automation-form.schedule_from') }}
                        </span>
                    </datetime>
                    <datetime class="calender">
                        <input type="text" name="schedule_to" class="form-control" v-model="schedule_to" ref="schedule_to"
                            placeholder="{{ __('admin::app.automations.to') }}"
                            v-validate="'date_format:yyyy-MM-dd HH:mm:ss|after:schedule_from'"
                            data-vv-as="&quot;{{ __('admin::app.automations.to') }}&quot;" />

                        <span class="control-error" v-if="errors.has('automation-form.schedule_to')">
                            @{{ errors.first('automation-form.schedule_to') }}
                        </span>
                    </datetime>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="at_period">{{ __('admin::app.automations.at_period') }}</label>                
                <input name="at_period" class="form-control" />
            </div>           

            
            <button type="submit" class="btn btn-md btn-primary">
                {{ __('admin::app.automations.save-btn-title') }}
            </button>

        </form>
    </script>

    <script>
        Vue.component('automation-action-component', {

            template: '#automation-action-component-template',

            props: ['data'],

            inject: ['$validator'],

            data: function() {
                return {
                    show_cc: false,

                    show_bcc: false,

                    schedule_from: null,

                    schedule_to: null,

                    search_term: '',

                    is_searching: false,

                    searched_participants: {
                        'users': [],

                        'persons': []
                    },

                    participants: {
                        'users': [],

                        'persons': []
                    },

                    selectType: "message",
                }
            },
            computed: {
                setPhone: function() {
                    return this.selectType === 'message' || this.selectType === 'call' ? this.phone : '';
                }
            },
            mounted: function() {
                var self = this;

                tinymce.init({
                    selector: 'textarea#reply',

                    height: 200,

                    width: "100%",

                    plugins: 'image imagetools media wordcount save fullscreen code table lists link hr',

                    toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor link hr | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent  | removeformat | code | table',

                    image_advtab: true,

                    setup: function(editor) {
                        editor.on('keyUp', function() {
                            self.$validator.validate('email-form.reply', this.getContent());
                        });
                    }
                });
            },

            methods: {
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

                    this.$http.get("{{ route('admin.automations.search_participants') }}", {
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
                            self.$http.post(`{{ route('admin.automations.check_overlapping') }}`, {
                                    schedule_from: self.schedule_from,
                                    schedule_to: self.schedule_to,
                                    participants: self.participants,
                                }).then(response => {
                                    if (!response.data.overlapping) {
                                        self.$root.onSubmit(e, formScope);
                                    } else {
                                        if (confirm(
                                                "{{ __('admin::app.automations.duration-overlapping') }}"
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
